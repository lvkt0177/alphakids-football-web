<?php

namespace App\Http\Controllers;

class RobotsController extends Controller
{
    public function index()
    {
        $content = "User-agent: *\nDisallow:\n\nSitemap: " . route('sitemap') . "\n";

        return response($content, 200)->header('Content-Type', 'text/plain');
    }
}
