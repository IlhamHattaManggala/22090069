<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class UpdateWebsite extends Controller
{
    public function update(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Ambil data website (asumsi hanya ada satu data)
            $website = WebsiteSetting::first();

            // Jika instance tidak ditemukan, buat instance baru
            if (!$website) {
                $website = new WebsiteSetting();
            }

            // Update nama website jika diubah
            $website->nama = $request->nama;

            // Proses logo baru jika diunggah
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $logoContent = file_get_contents($logo->getRealPath());
                $website->logo = $logoContent;
            }

            $website->save(); // Simpan perubahan ke database

            return redirect()->back()->with('success', 'Website setting berhasil diperbarui.');
        } catch (ValidationException $e) {
            // Tangkap exception validasi dan tampilkan pesan SweetAlert
            return redirect()->back()->with('error', 'Format gambar yang diunggah harus jpeg, png, jpg, atau gif.');
        }
    }
}
