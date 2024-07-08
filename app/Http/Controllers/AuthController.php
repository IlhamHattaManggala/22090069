<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;
use Exception;

class AuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $oauthUser = Socialite::driver('google')->user();
            $email = $oauthUser->getEmail();

            if ($email) {
                $user = User::where('email', $email)->first();

                if ($user) {
                    Auth::login($user);
                    // Redirect sesuai peran pengguna setelah login
                    if ($user->role === 'admin') {
                        return redirect()->route('admin.dashboard');
                    } else {
                        return redirect()->route('user.home');
                    }
                } else {
                    $now = now();
                    $token1 = Str::random(60);
                    $remember = Str::random(10);
                    // Jika email tidak terdaftar, buat akun baru
                    $user = User::create([
                        'name' => $oauthUser->getName(),
                        'email' => $email,
                        'email_verified_at' => $now,
                        'email_verification_token' => $token1,
                        'remember_token' => $remember,
                        'password' => bcrypt(Str::random(16)), // Password acak
                        'role' => 'user', // Atur default role, bisa diubah sesuai kebutuhan
                        'avatar' => $oauthUser->getAvatar() // Simpan gambar profil dari Google jika ada
                    ]);

                    Auth::login($user);
                    return redirect()->route('user.home');
                }
            } else {
                // Tangani kasus ketika email tidak ditemukan dalam respon OAuth
                return redirect()->route('login')->withErrors(['email' => 'Unable to retrieve email from Google.']);
            }
        } catch (Exception $e) {
            return redirect()->route('login')->withErrors(['email' => 'Internal Server Error. Please try again later.']);
        }
    }


    public function handleFacebookCallback()
    {
        try {
            $oauthUser = Socialite::driver('facebook')->user();
            $email = $oauthUser->getEmail();

            if ($email) {
                $user = User::where('email', $email)->first();

                if ($user) {
                    Auth::login($user);
                    if ($user->role === 'admin') {
                        return redirect()->route('admin.dashboard');
                    } else {
                        return redirect()->route('user.dashboard');
                    }
                } else {
                    $now = now();
                    $token1 = Str::random(60);
                    $remember = Str::random(10);
                    // Jika email tidak terdaftar, buat akun baru
                    $user = User::create([
                        'name' => $oauthUser->getName(),
                        'email' => $email,
                        'email_verified_at' => $now,
                        'email_verification_token' => $token1,
                        'remember_token' => $remember,
                        'password' => bcrypt(Str::random(16)), // Password acak
                        'role' => 'user', // Atur default role, bisa diubah sesuai kebutuhan
                        'avatar' => $oauthUser->getAvatar() // Simpan gambar profil dari Facebook jika ada
                    ]);

                    Auth::login($user);
                    return redirect()->route('user.dashboard');
                }
            } else {
                return redirect()->route('login')->withErrors(['email' => 'Unable to retrieve email from Facebook.']);
            }
        } catch (Exception $e) {
            return redirect()->route('login')->withErrors(['email' => 'Internal Server Error. Please try again later.']);
        }
    }
}
