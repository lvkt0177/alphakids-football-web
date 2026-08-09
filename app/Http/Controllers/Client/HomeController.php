<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $bannerImage = Setting::get('home_banner');

        return view('client.home', compact('bannerImage'));
    }
}
