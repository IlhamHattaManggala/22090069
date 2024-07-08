<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\WebsiteSetting;

class LoginController extends Controller
{
    public function login()
    {
        $website = WebsiteSetting::first();
        return view('auth.login', compact('website'));
    }
    public function login_proses(Request $request)
    {
        $request->validate([
            'email'     => 'required',
            'password'  => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.home');
            }
        } else {
            return redirect()->route('login')->with('failed', 'Email atau Password Salah');
        }
    }
    public function logout()
    {
        Auth::logout(); // Lakukan proses logout

        return redirect()->route('home'); // Redirect kembali ke halaman login
    }
}
