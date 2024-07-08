<?php

namespace App\Http\Controllers;

use App\Models\alternatif;
use App\Models\artifacts;
use App\Models\Elements;
use App\Models\Karakter;
use App\Models\Nilai;
use App\Models\User;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class UserController extends Controller
{
    //
    public function home()
    {
        $website = WebsiteSetting::first();
        $kolomNilai = Schema::getColumnListing('nilai');
        $excludeNilai = ['id_penilaian', 'karakter_id_karakter'];
        $nilaiHome = array_diff($kolomNilai, $excludeNilai);
        $columnOrder = array_values($nilaiHome);
        return view('user.home', compact('website', 'columnOrder', 'nilaiHome')); // Mengirim kedua variabel ke tampilan
    }

    public function karakter(Request $request)
    {
        $columns = Schema::getColumnListing('nilai');
        $excludeColumns = ['id_penilaian', 'karakter_id_karakter'];
        $filteredColumns = array_diff($columns, $excludeColumns);
        $columnOrder = array_values($filteredColumns);
        $website = WebsiteSetting::first();
        $mondstadt = Karakter::where('region', 'Mondstadt')->get();
        $liyue = Karakter::where('region', 'Liyue')->get();
        $inazuma = Karakter::where('region', 'Inazuma')->get();
        $sumeru = Karakter::where('region', 'Sumeru')->get();
        $fontaine = Karakter::where('region', 'Fontaine')->get();
        $snezhnaya = Karakter::where('region', 'Snezhnaya')->get();

        return view('user.karakter', compact('website', 'liyue', 'columnOrder', 'snezhnaya', 'fontaine', 'inazuma', 'sumeru', 'mondstadt'));
    }
}
