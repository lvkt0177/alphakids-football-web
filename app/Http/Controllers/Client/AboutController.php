<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Setting;

class AboutController extends Controller
{
    public function index()
    {
        $images = [
            'about_banner' => Setting::get('about_banner'),
            'about_letter_photo' => Setting::get('about_letter_photo'),
            'about_letter_photo_2' => Setting::get('about_letter_photo_2'),
            'about_letter_photo_3' => Setting::get('about_letter_photo_3'),
            'about_closing_cta_photo' => Setting::get('about_closing_cta_photo'),
        ];

        $letter = [
            'name' => Setting::get('about_letter_name'),
            'role' => Setting::get('about_letter_role'),
            'message' => Setting::get('about_letter_message'),
        ];

        $ogImage = $images['about_banner'] ? asset('storage/' . $images['about_banner']) : null;

        return view('client.about', compact('images', 'letter', 'ogImage'));
    }
}
