<?php

namespace App\Http\Controllers;

use App\Models\Karakter;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\Bobot;
use App\Models\TipeKriteria;
use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RekomendasiController extends Controller
{
    public function addCharacter(Request $request)
    {
        // Validasi input
        $request->validate([
            'character_id' => 'required|exists:karakter,id_karakter'
        ]);

        // Ambil karakter dari database
        $character = Karakter::find($request->character_id);

        // Ambil bobot terakhir untuk pengguna saat ini
        $latestBobot = Bobot::where('users_id', Auth::id())->latest('waktu')->first();

        // Ambil daftar karakter dari session (jika ada)
        $characters = $request->session()->get('characters', []);

        // Tambahkan karakter ke dalam session
        $characters[] = $character;

        // dd($characters);
        // Simpan kembali ke session
        $request->session()->put('characters', $characters);

        // Redirect kembali ke halaman rekomendasi
        return redirect()->route('user.rekomendasi');
    }

    public function deleteCharacter(Request $request, $characterId)
    {
        // Ambil daftar karakter dari session (jika ada)
        $characters = $request->session()->get('characters', []);

        // Hapus karakter dari daftar
        foreach ($characters as $index => $character) {
            if ($character->id_karakter == $characterId) {
                unset($characters[$index]);
                break;
            }
        }

        // Simpan kembali daftar yang telah diperbarui ke session
        $request->session()->put('characters', array_values($characters));

        // Redirect kembali ke halaman rekomendasi
        return redirect()->route('user.rekomendasi');
    }

    public function rekomendasi()
    {
        // Fetch all characters for the dropdown
        $allCharacters = Karakter::whereIn('id_karakter', function ($query) {
            $query->select('karakter_id_karakter')
                  ->from('nilai');
        })->get();
        $nilai = Nilai::all();
        $allChars = Karakter::with('nilai')->get();

        // Fetch columns except those not to be displayed
        $columns = Schema::getColumnListing('nilai');
        $excludeColumns = ['karakter_id_karakter', 'id_penilaian', 'pembobotan_id_bobot'];
        $filteredColumns = array_diff($columns, $excludeColumns);
        $columnOrder = array_values($filteredColumns);

        // Fetch characters from session
        $characters = session('characters', []);

        // Fetch the latest bobot record for the current user
        $latestBobot = Bobot::where('users_id', Auth::id())->latest('waktu')->first();
        Log::info('Latest Bobot:', ['latestBobot' => $latestBobot]);

        // Fetch all bobot records
        $bobots = Bobot::all();
        $columnBobot = Schema::getColumnListing('pembobotan');

        $tipeKriteria = TipeKriteria::all()->pluck('tipe', 'nama');
        $results = [];
        $website = WebsiteSetting::first();
        $colKriteria = Schema::getColumnListing('nilai');
        // Columns to exclude
        $exKriteria = ['id_penilaian', 'karakter_id_karakter'];
        // Filter columns
        $KriteriaSelect = array_values(array_diff($colKriteria, $exKriteria));

        return view('user.rekomendasi', compact('allCharacters', 'KriteriaSelect', 'results', 'website', 'characters', 'columnOrder', 'columns', 'nilai', 'allChars', 'latestBobot', 'columnBobot', 'bobots', 'results', 'tipeKriteria'));
    }

    public function addData(Request $request)
    {
        // Validasi input untuk w1 hingga w6
        for ($i = 1; $i <= 6; $i++) {
            $request->validate([
                "w$i" => 'required|numeric',
            ]);
        }

        // Simpan data ke tabel pembobotan
        $data = [
            'users_id' => Auth::id(), // assuming you are using Laravel's default authentication
            'waktu' => now(),
        ];

        for ($i = 1; $i <= 6; $i++) {
            $data["w$i"] = $request->input("w$i");
        }

        Bobot::create($data);
        

        // Redirect atau lakukan hal lain setelah data disimpan
        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }
}
