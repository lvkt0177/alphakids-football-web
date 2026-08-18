<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $routes = [
            ['name' => 'home', 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['name' => 'about', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['name' => 'method', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['name' => 'program', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['name' => 'activity.index', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['name' => 'branch.index', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['name' => 'faq', 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['name' => 'registration.create', 'priority' => '0.9', 'changefreq' => 'yearly'],
        ];

        $xml = view('sitemap', compact('routes'))->render();

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
