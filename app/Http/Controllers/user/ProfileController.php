<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $website = WebsiteSetting::first();
        return view('user.profileUser', compact('website'));
    }
}
