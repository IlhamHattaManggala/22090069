<?php

namespace App\Http\Controllers\Pesan;

use App\Http\Controllers\Controller;
use App\Models\Pesan;
use Illuminate\Http\Request;

class FeedbackStore extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'alamat' => 'required|string|max:255',
            'pesan' => 'required|string',
        ]);

        $pesan = new Pesan;
        $pesan->nama_lengkap = $request->name;
        $pesan->email = $request->email;
        $pesan->alamat = $request->alamat;
        $pesan->pesan = $request->pesan;
        $pesan->save();

        return back()->with('success', 'Pesan Anda Telah Terkirim, Terimakasih!');
    }
}
