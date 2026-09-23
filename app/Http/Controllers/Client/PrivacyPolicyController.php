<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        return view('client.policy.privacy');
    }
}
