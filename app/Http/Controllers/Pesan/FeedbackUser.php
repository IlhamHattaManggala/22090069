<?php

namespace App\Http\Controllers\Pesan;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;

class FeedbackUser extends Controller
{
    public function show(){
        $website = WebsiteSetting::first();
        return view('user.feedback', compact('website'));
    }
}
