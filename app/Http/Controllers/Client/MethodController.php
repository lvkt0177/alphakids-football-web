<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Setting;

class MethodController extends Controller
{
    public function index()
    {
        $images = [
            'method_banner' => Setting::get('method_banner'),
            'method_care_celebrate' => Setting::get('method_care_celebrate'),
            'method_care_ask_answer' => Setting::get('method_care_ask_answer'),
            'method_care_repetition' => Setting::get('method_care_repetition'),
            'method_care_enjoy_strict' => Setting::get('method_care_enjoy_strict'),
            'method_heart_banner' => Setting::get('method_heart_banner'),
            'method_closing_cta_photo' => Setting::get('method_closing_cta_photo'),
        ];

        return view('client.method', compact('images'));
    }
}
