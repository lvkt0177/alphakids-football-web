<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Account\ChangePasswordRequest;

class AccountController extends Controller
{
    public function edit()
    {
        return view('admin.account.edit');
    }

    public function updatePassword(ChangePasswordRequest $request)
    {
        $request->user()->update([
            'password' => $request->validated()['password'],
        ]);

        return redirect()->route('admin.account.edit')->with('success', 'Đã đổi mật khẩu thành công.');
    }
}
