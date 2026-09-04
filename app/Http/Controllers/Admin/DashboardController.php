<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RegistrationStatus;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Branch;
use App\Models\Registration;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'registrations_total' => Registration::count(),
            'registrations_pending' => Registration::where('status', RegistrationStatus::PENDING)->count(),
            'activities_active' => Activity::where('is_active', true)->count(),
            'branches_active' => Branch::where('is_active', true)->count(),
        ];

        $latestRegistrations = Registration::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestRegistrations'));
    }
}