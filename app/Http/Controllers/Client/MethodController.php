<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class MethodController extends Controller
{
    public function index()
    {
        return view('client.method');
    }
}