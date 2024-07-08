<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateProfile extends Controller
{
    public function updateProfile(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'name' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255',
                'password' => 'nullable|string|min:8',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Ambil pengguna yang sedang login
            $user = User::find(Auth::id());

            // Update nama jika diubah
            if ($request->filled('name')) {
                $user->name = $request->name;
            }

            // Update email jika diubah
            if ($request->filled('email')) {
                $user->email = $request->email;
            }

            // Update password jika diubah
            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }

            // Proses avatar baru jika diunggah
            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $avatarContent = file_get_contents($avatar->getRealPath());
                $user->avatar = $avatarContent;
            }

            $user->save(); // Simpan perubahan ke database

            return redirect()->back()->with('success', 'Profile berhasil diperbarui.');
        } catch (ValidationException $e) {
            // Tangkap exception validasi dan tampilkan pesan SweetAlert
            return redirect()->back()->with('error', 'Format gambar yang diunggah harus jpeg, png, jpg, atau gif.');
        }
    }
}
