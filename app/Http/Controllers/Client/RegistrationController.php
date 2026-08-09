<?php

namespace App\Http\Controllers\Client;

use App\Enums\RegistrationStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\QuickRegistrationRequest;
use App\Http\Requests\Client\RegistrationRequest;
use App\Models\Branch;
use App\Models\Registration;

class RegistrationController extends Controller
{
    public function create()
    {
        $branches = Branch::active()->ordered()->get();

        return view('client.registration.create', compact('branches'));
    }

    public function store(RegistrationRequest $request)
    {
        $registration = Registration::create([
            ...$request->validated(),
            'status' => RegistrationStatus::PENDING,
        ]);

        $registration->branches()->sync($request->input('branches', []));

        return back()->with('success', 'Đăng ký thành công! Chúng tôi sẽ liên hệ với bạn sớm nhất.');
    }

    public function quickStore(QuickRegistrationRequest $request)
    {
        Registration::create([
            ...$request->validated(),
            'status' => RegistrationStatus::PENDING,
        ]);

        return back()->with('success', 'Đăng ký thành công! Chúng tôi sẽ liên hệ với bạn sớm nhất.');
    }
}