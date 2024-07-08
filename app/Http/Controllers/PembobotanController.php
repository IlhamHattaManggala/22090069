<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Models\User;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class PembobotanController extends Controller
{
    public function index()
    {
        $bobot = Bobot::with('user')->get();
        $user = User::all();
        $columns = Schema::getColumnListing('pembobotan');
        $website = WebsiteSetting::first();
        return view('admin.pembobotan', compact('bobot', 'columns', 'user', 'website'));
    }

    public function store(Request $request)
    {
        // Dapatkan semua kolom kecuali primary key
        $columns = Schema::getColumnListing('pembobotan');
        $fillableColumns = array_diff($columns, ['id_bobot']);

        // Validasi data
        $validatedData = $request->validate($this->getValidationRules($fillableColumns));

        // Buat instance baru dari model Nilai
        $bobot = new Bobot();
        foreach ($fillableColumns as $column) {
            if (array_key_exists($column, $validatedData)) {
                $bobot->$column = $validatedData[$column];
            }
        }
        $bobot->save();

        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request, Bobot $bobot)
    {
        // Dapatkan semua kolom kecuali primary key
        $columns = Schema::getColumnListing('pembobotan');
        $exclude = ['id_bobot'];
        $fillableColumns = array_diff($columns, $exclude);

        // Validasi data
        $validatedData = $request->validate($this->getValidationRules($fillableColumns));

        // Update model Bobot
        foreach ($fillableColumns as $column) {
            if (array_key_exists($column, $validatedData)) {
                $bobot->$column = $validatedData[$column];
            }
        }
        $bobot->save();

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }

    private function getValidationRules(array $columns)
    {
        $rules = [];
        foreach ($columns as $column) {
            $rules[$column] = 'required';
        }
        return $rules;
    }

    public function destroy(Bobot $bobot)
    {
        $bobot->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
