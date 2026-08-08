<?php

namespace App\Http\Controllers\Client;

use App\Enums\RegistrationStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\RegistrationRequest;
use App\Models\Registration;

class RegistrationController extends Controller
{
    public function store(RegistrationRequest $request)
    {
        $registration = Registration::create([
            ...$request->validated(),
            'status' => RegistrationStatus::PENDING,
        ]);

        $registration->branches()->sync($request->input('branches', []));

        return back()->with('success', 'Đăng ký thành công! Chúng tôi sẽ liên hệ với bạn sớm nhất.');
    }
}