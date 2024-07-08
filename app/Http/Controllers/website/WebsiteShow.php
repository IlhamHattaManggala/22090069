<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;

class WebsiteShow extends Controller
{
    public function show(){
        $website = WebsiteSetting::first();
        return view('admin.SettingWebsite.website', compact('website'));
    }
}
