<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Models\Karakter;
use App\Models\Nilai;
use App\Models\User;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class PenilaianController extends Controller
{
    public function index()
    {
        // Mendapatkan daftar karakter yang sudah ada di tabel nilai
        $karakterSudahAda = Nilai::pluck('karakter_id_karakter')->toArray();

        // Mendapatkan daftar karakter yang belum ada di tabel nilai
        $karakterBelumAda = Karakter::whereNotIn('id_karakter', $karakterSudahAda)->get();

        $nilai = Nilai::with('karakter')->get();
        $columns = Schema::getColumnListing('nilai');
        $bobot = Bobot::all();
        $user = User::all();
        $website = WebsiteSetting::first();
        $karakter = Karakter::all();

        return view('admin.penilaian', compact('nilai', 'karakter', 'karakterBelumAda', 'columns', 'bobot', 'user', 'website'));
    }


    public function store(Request $request)
    {
        // Dapatkan semua kolom kecuali primary key
        $columns = Schema::getColumnListing('nilai');
        $fillableColumns = array_diff($columns, ['id_penilaian']);

        // Validasi data
        $validatedData = $request->validate($this->getValidationRules($fillableColumns));

        // Buat instance baru dari model Nilai
        $nilai = new Nilai();
        foreach ($fillableColumns as $column) {
            if (array_key_exists($column, $validatedData)) {
                $nilai->$column = $validatedData[$column];
            }
        }
        $nilai->save();

        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request, Nilai $nilai)
    {
        // Dapatkan semua kolom kecuali primary key
        $columns = Schema::getColumnListing('nilai');
        $fillableColumns = array_diff($columns, ['id_penilaian']);

        // Validasi data
        $validatedData = $request->validate($this->getValidationRules($fillableColumns));

        // Update model Nilai
        foreach ($fillableColumns as $column) {
            if (array_key_exists($column, $validatedData)) {
                $nilai->$column = $validatedData[$column];
            }
        }
        $nilai->save();

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Nilai $nilai)
    {
        $nilai->delete();
        Karakter::where('id', $nilai->karakter_id_karakter)->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    private function getValidationRules(array $columns)
    {
        $rules = [];
        foreach ($columns as $column) {
            $rules[$column] = 'required|numeric';
        }
        $rules['karakter_id_karakter'] = 'required|exists:karakter,id_karakter';
        return $rules;
    }
}
