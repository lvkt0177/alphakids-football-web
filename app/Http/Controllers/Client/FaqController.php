<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Setting;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::active()->ordered()->get();

        $images = [
            'faq_banner' => Setting::get('faq_banner'),
            'faq_closing_cta_photo' => Setting::get('faq_closing_cta_photo'),
        ];

        return view('client.faq', compact('faqs', 'images'));
    }
}