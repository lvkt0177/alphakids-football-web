<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class ProgramController extends Controller
{
    public function index()
    {
        return view('client.program');
    }
}