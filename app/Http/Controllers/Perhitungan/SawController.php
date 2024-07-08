<?php

namespace App\Http\Controllers\Perhitungan;

use App\Http\Controllers\Controller;
use App\Models\Bobot;
use App\Models\Karakter;
use App\Models\Nilai;
use App\Models\TipeKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class SawController extends Controller
{
    public function HitungSAW()
    {
        $colKriteria = Schema::getColumnListing('nilai');
        // Columns to exclude
        $exKriteria = ['id_penilaian', 'karakter_id_karakter'];
        // Filter columns
        $KriteriaSelect = array_values(array_diff($colKriteria, $exKriteria));
        $user_id = Auth::id();

        // Fetch the latest weights used by the user
        $bobots = Bobot::where('users_id', $user_id)->latest('waktu')->first();
        if (!$bobots) {
            return redirect()->route('user.rekomendasi')->with('error', 'Bobot not found.');
        }

        $BobotSelect = array_values(array_diff(Schema::getColumnListing('pembobotan'), ['id_bobot', 'users_id', 'waktu']));
        $bobotsArray = $bobots->toArray();

        // Normalize the Bobot values
        $normalizedBobots = [];
        $totalSum = 0;

        // Calculate the total sum of all weights
        foreach ($BobotSelect as $column) {
            $totalSum += $bobotsArray[$column];
        }

        // Normalize each Bobot value
        foreach ($BobotSelect as $column) {
            $normalizedBobots[$column] = $bobotsArray[$column] / $totalSum;
        }

        session()->put('normalized_bobots', $normalizedBobots);

        // Fetch criteria types
        $tipekriteria = TipeKriteria::whereIn('nama', $KriteriaSelect)->pluck('tipe', 'nama')->toArray();

        $charList = session()->get('characters', []);
        $characterIds = array_map(function ($character) {
            return $character['id_karakter'];
        }, $charList);

        $selectedCharacters = Nilai::whereIn('karakter_id_karakter', $characterIds)->get();

        // Calculate MAX for benefit criteria and MIN for cost criteria
        $maxValues = [];
        $minValues = [];
        foreach ($tipekriteria as $kriteriaName => $kriteriaType) {
            $values = $selectedCharacters->pluck($kriteriaName)->toArray();
            if ($kriteriaType === 'Benefit') {
                $maxValues[$kriteriaName] = max($values);
            } elseif ($kriteriaType === 'Cost') {
                $minValues[$kriteriaName] = min($values);
            }
        }

        session()->put('maxValues', $maxValues);
        session()->put('minValues', $minValues);

        $normalizedValues = [];
        foreach ($selectedCharacters as $character) {
            $characterNormalized = [];
            foreach ($KriteriaSelect as $kriteriaName) {
                $kriteriaType = $tipekriteria[$kriteriaName];
                if ($kriteriaType === 'Benefit') {
                    $characterNormalized[$kriteriaName] = $character->$kriteriaName / $maxValues[$kriteriaName];
                } elseif ($kriteriaType === 'Cost') {
                    $characterNormalized[$kriteriaName] = $minValues[$kriteriaName] / $character->$kriteriaName;
                }
            }
            $normalizedValues[$character->karakter_id_karakter] = $characterNormalized;
        }

        session()->put('normalisasi_saw', $normalizedValues);

        $preferenceValues = [];
        foreach ($normalizedValues as $characterId => $characterNormalized) {
            $preferenceValue = 0;
            foreach ($KriteriaSelect as $index => $kriteriaName) {
                if (isset($BobotSelect[$index])) {
                    $weightKey = $BobotSelect[$index];
                    $preferenceValue += $characterNormalized[$kriteriaName] * $normalizedBobots[$weightKey];
                }
            }
            $preferenceValues[$characterId] = $preferenceValue;
        }

        session()->put('preferensi_saw', $preferenceValues);

        // Fetch the character information
        $charSAW = Karakter::whereIn('id_karakter', $characterIds)->get(['id_karakter', 'nama', 'gambar']);
        $charSAWData = $charSAW->keyBy('id_karakter')->toArray();

        // Sort preference values in descending order
        arsort($preferenceValues);

        // Rank the characters based on preference values
        $rankedSAWData = [];
        $rankSAW = 1;
        foreach ($preferenceValues as $characterId => $nilaiSAW) {
            $rankedItemSAW = new \stdClass();
            $rankedItemSAW->rank_saw = $rankSAW++;
            $rankedItemSAW->nilai_preferensi_saw = $nilaiSAW;
            $rankedItemSAW->nama_karakter_saw = $charSAWData[$characterId]['nama'];
            $rankedItemSAW->gambar_karakter_saw = $charSAWData[$characterId]['gambar'];
            $rankedItemSAW->normalisasi = $normalizedValues[$characterId];
            $rankedItemSAW->nilai_asli = $selectedCharacters->where('karakter_id_karakter', $characterId)->first()->toArray();
            $rankedItemSAW->minmax = [
                'max' => $maxValues,
                'min' => $minValues
            ];
            $rankedSAWData[] = $rankedItemSAW;
        }

        session()->put('ranked_data_saw', $rankedSAWData);

        return redirect()->route('user.rekomendasi')->with('success', 'Perhitungan SAW berhasil.');
    }
}
