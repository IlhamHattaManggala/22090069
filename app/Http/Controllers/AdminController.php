<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Models\Nilai;
use App\Models\User;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use ipinfo\ipinfo\IPinfo;

class AdminController extends Controller
{
    public function dashboard()
    {
        $usersCount = User::count();
        $nilaiCount = Nilai::count();
        $pembobotanCount = Bobot::count();
        $user = User::all();
        $website = WebsiteSetting::first();
        $queryCount = DB::table('telescope_entries')
            ->where('type', 'query')
            ->count();

            $accessToken = '351d8ccd4e6607';
            $client = new IPinfo($accessToken);
    
            // Ambil informasi IP
            $details = $client->getDetails();
    
            // Data yang akan dikirim ke view
            $locationData = [
                'ip' => $details->ip,
                'city' => $details->city,
                'region' => $details->region,
                'country' => $details->country,
            ];

        return view('admin.dashboard', compact('user', 'locationData', 'website', 'usersCount', 'nilaiCount', 'pembobotanCount', 'queryCount'));
    }

    public function userAll()
    {
        $user = User::all();
        // Filter users based on their roles
        $adminUsers = User::where('role', 'admin')->get();
        $userUsers = User::where('role', 'user')->get();
        $userUsersuser = User::where('role', 'user')->get();
        $website = WebsiteSetting::first();

        // Return the view with filtered users
        return view('admin.akun', compact('adminUsers', 'userUsers', 'user', 'website'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'required',
        ]);

        // Create new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success', 'User berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
