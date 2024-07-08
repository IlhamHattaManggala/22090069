<?php

namespace App\Http\Controllers\Perhitungan;

use App\Http\Controllers\Controller;
use App\Models\Bobot;
use App\Models\Karakter;
use App\Models\Nilai;
use App\Models\TipeKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TopsisController extends Controller
{
    public function HitungTopsis()
    {
        // Fetch column names from the 'nilai' table
        $colKriteria = Schema::getColumnListing('nilai');
        // Columns to exclude
        $exKriteria = ['id_penilaian', 'karakter_id_karakter'];
        // Filter columns
        $KriteriaSelect = array_values(array_diff($colKriteria, $exKriteria)); // Use array_values to reset keys

        // Get the current user ID
        $user_id = Auth::id();

        // Fetch the latest weights used by the user
        $bobots = Bobot::where('users_id', $user_id)->latest('waktu')->first();
        if (!$bobots) {
            return redirect()->route('user.rekomendasi')->with('error', 'Bobot not found.');
        }

        // Calculate the sum of squares for normalization
        $sum_of_squares = $this->hitungSumOfSquares();
        if (!$sum_of_squares) {
            return redirect()->route('user.rekomendasi')->with('error', 'Error calculating square root.');
        }

        // Calculate square roots for normalization
        $sqrt_result = [];
        foreach ($sum_of_squares->toArray() as $key => $value) {
            $sqrt_result[$key] = sqrt($value);
        }
        session()->put('sqrt_result', $sqrt_result);

        // Normalize the data
        $charList = session()->get('characters', []);
        $characterIds = array_map(function ($character) {
            return $character['id_karakter'];
        }, $charList);

        $selectedCharacters = Nilai::whereIn('karakter_id_karakter', $characterIds)->get();
        $normalized_karakter = [];
        foreach ($selectedCharacters as $item) {
            $normalized_item = new \stdClass();
            foreach ($KriteriaSelect as $criterion) {
                $normalized_item->$criterion = $item->$criterion / $sqrt_result[$criterion];
            }
            $normalized_karakter[] = $normalized_item;
        }
        session()->put('normalized_karakter', $normalized_karakter);

        // Weighted normalization
        $BobotSelect = array_values(array_diff(Schema::getColumnListing('pembobotan'), ['id_bobot', 'users_id', 'waktu']));
        $weighted_normalized_karakter = [];
        foreach ($normalized_karakter as $item) {
            $weighted_normalized_item = new \stdClass();
            foreach ($KriteriaSelect as $index => $criterion) {
                if (isset($BobotSelect[$index])) {
                    $weightKey = $BobotSelect[$index]; // Use dynamic weight key
                    $weighted_normalized_item->$criterion = $item->$criterion * $bobots->$weightKey;
                }
            }
            $weighted_normalized_karakter[] = $weighted_normalized_item;
        }
        session()->put('weighted_normalized_karakter', $weighted_normalized_karakter);

        // Calculate ideal positive and negative solutions
        $tipeKriteria = TipeKriteria::whereIn('nama', $KriteriaSelect)->pluck('tipe', 'nama')->toArray();
        $idealPositif = [];
        $idealNegatif = [];
        foreach ($KriteriaSelect as $criterion) {
            if ($tipeKriteria[$criterion] == 'Benefit') {
                $idealPositif[$criterion] = max(array_column($weighted_normalized_karakter, $criterion));
                $idealNegatif[$criterion] = min(array_column($weighted_normalized_karakter, $criterion));
            } elseif ($tipeKriteria[$criterion] == 'Cost') {
                $idealPositif[$criterion] = min(array_column($weighted_normalized_karakter, $criterion));
                $idealNegatif[$criterion] = max(array_column($weighted_normalized_karakter, $criterion));
            }
        }
        session()->put('idealPositif', $idealPositif);
        session()->put('idealNegatif', $idealNegatif);

        // Calculate distances to ideal solutions
        $jarakPositif = [];
        $jarakNegatif = [];
        foreach ($weighted_normalized_karakter as $item) {
            $jarakPos = 0;
            $jarakNeg = 0;
            foreach ($KriteriaSelect as $criterion) {
                $jarakPos += pow($item->$criterion - $idealPositif[$criterion], 2);
                $jarakNeg += pow($item->$criterion - $idealNegatif[$criterion], 2);
            }
            $jarakPositif[] = sqrt($jarakPos);
            $jarakNegatif[] = sqrt($jarakNeg);
        }
        session()->put('jarakPositif', $jarakPositif);
        session()->put('jarakNegatif', $jarakNegatif);

        // Calculate preference values
        $nilaiPreferensi = [];
        foreach ($jarakNegatif as $key => $value) {
            $nilaiPreferensi[] = $value / ($value + $jarakPositif[$key]);
        }
        session()->put('nilai_preferensi', $nilaiPreferensi);

        // Retrieve character names and images, and rank
        $characters = Karakter::whereIn('id_karakter', $characterIds)->get(['id_karakter', 'nama', 'gambar']);
        $characterData = $characters->keyBy('id_karakter')->toArray();

        arsort($nilaiPreferensi); // Sort preference values in descending order

        $rankedData = [];
        $rank = 1;
        foreach ($nilaiPreferensi as $key => $nilai) {
            $rankedItem = new \stdClass();
            $rankedItem->rank = $rank++;
            $rankedItem->nilai_preferensi = $nilai;
            $rankedItem->nama_karakter = $characterData[$characterIds[$key]]['nama'];
            $rankedItem->gambar_karakter = $characterData[$characterIds[$key]]['gambar'];
            $rankedItem->normalisasi = [];
            foreach ($KriteriaSelect as $criterion) {
                $rankedItem->normalisasi[$criterion] = $normalized_karakter[$key]->$criterion;
            }
            $rankedItem->normalisasi_terbobot = [];
            foreach ($KriteriaSelect as $criterion) {
                $rankedItem->normalisasi_terbobot[$criterion] = $weighted_normalized_karakter[$key]->$criterion;
            }
            $rankedItem->idealPositif = [];
            $rankedItem->idealNegatif = [];
            foreach ($KriteriaSelect as $criterion) {
                $rankedItem->idealPositif[$criterion] = $idealPositif[$criterion];
                $rankedItem->idealNegatif[$criterion] = $idealNegatif[$criterion];
            }
            // Tambahkan jarak positif dan negatif
            $rankedItem->jarakPositif = $jarakPositif[$key];
            $rankedItem->jarakNegatif = $jarakNegatif[$key];

            $rankedData[] = $rankedItem;
        }
        session()->put('ranked_data_topsis', $rankedData);

        // Redirect to the recommendation page with success message
        return redirect()->route('user.rekomendasi')->with('success', 'Perhitungan TOPSIS selesai.');
    }

    private function hitungSumOfSquares()
    {
        // Fetch columns from the 'nilai' table
        $columns = Schema::getColumnListing('nilai');
        // Columns to exclude
        $exclude = ['id_penilaian', 'karakter_id_karakter'];
        // Filter columns
        $criteria = array_diff($columns, $exclude);

        // Create an array to store DB::raw statements
        $sumOfSquaresArray = [];
        // Create DB::raw statements for each relevant column
        foreach ($criteria as $kriteria) {
            $sumOfSquaresArray[] = DB::raw("SUM(POW($kriteria, 2)) as $kriteria");
        }

        // Execute the query with the created statements
        $sum_of_squares = Nilai::select($sumOfSquaresArray)->first();

        return $sum_of_squares;
    }
}
