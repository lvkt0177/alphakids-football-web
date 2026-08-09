<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class ActivityController extends Controller
{
    public function index()
    {
        return view('client.activity.index');
    }
}