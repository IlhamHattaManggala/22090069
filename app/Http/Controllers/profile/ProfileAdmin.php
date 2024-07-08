<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileAdmin extends Controller
{
    public function index(){
        $users = User::where(Auth::user());
        $website = WebsiteSetting::first();
        return view('admin.profile.profile', compact('users', 'website'));
    } 
}
