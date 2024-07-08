<?php

namespace App\Http\Controllers;

use App\Models\alternatif;
use App\Models\Karakter;
use App\Models\Nilai;
use App\Models\User;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AlternatifController extends Controller
{
    protected $elements = ['Pyro', 'Hydro', 'Anemo', 'Electro', 'Geo', 'Cryo', 'Dendro'];
    protected $regions = ['Mondstadt', 'Liyue', 'Inazuma', 'Sumeru', 'Fontaine', 'Natlan', 'Snezhnaya'];
    protected $rarities = ['3 Star', '4 Star', '5 Star'];

    public function alternatif()
    {
        $user = User::all();
        $karakter = Karakter::all();
        $website = WebsiteSetting::first();
        return view('admin.alternatif', [
            'karakter' => $karakter,
            'elements' => $this->elements,
            'regions' => $this->regions,
            'rarities' => $this->rarities,
        ], compact('user', 'website'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'element' => 'nullable|string|in:' . implode(',', $this->elements),
                'region' => 'nullable|string|in:' . implode(',', $this->regions),
                'rarity' => 'nullable|string|in:' . implode(',', $this->rarities),
                'gambar' => 'required|image|max:2048',
            ]);

            // Cek apakah karakter dengan nama yang sama sudah ada
            $existingKarakter = Karakter::where('nama', $request->nama)->first();
            if ($existingKarakter) {
                return redirect()->back()->with('error', 'Karakter dengan nama tersebut sudah ada.');
            }

            // Ambil konten gambar
            $gambar = $request->file('gambar');
            $gambarContent = file_get_contents($gambar->getRealPath());

            // Buat instance Karakter baru
            $karakter = new Karakter();
            $karakter->nama = $request->nama;
            $karakter->element = $request->element ?: null;
            $karakter->region = $request->region ?: null;  
            $karakter->rarity = $request->rarity ?: null;
            $karakter->gambar = $gambarContent; 

            $karakter->save();

            return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Tangkap dan log exception jika terjadi kesalahan
            Log::error('Terjadi kesalahan:', ['message' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Karakter $karakter)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'element' => 'nullable|string|in:' . implode(',', $this->elements),
            'region' => 'nullable|string|in:' . implode(',', $this->regions),
            'rarity' => 'nullable|string|in:' . implode(',', $this->rarities),
            'gambar' => 'nullable|image|max:2048',
        ]);

        $karakter->nama = $request->nama;
        $karakter->element = $request->element ?: null;
        $karakter->region = $request->region ?: null;
        $karakter->rarity = $request->rarity ?: null;

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageData = file_get_contents($image->getRealPath()); // Get the content of the file
            $karakter->gambar = $imageData;
        }

        $karakter->save();

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Karakter $karakter)
    {
        $karakter->delete();
        Nilai::where('karakter_id_karakter', $karakter->id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
