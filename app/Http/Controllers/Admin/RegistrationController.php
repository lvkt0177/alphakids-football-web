<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Registration\RegistrationRequest;
use App\Models\Branch;
use App\Models\Registration;

class RegistrationController extends Controller
{
    public function index()
    {
        $query = Registration::query()->latest();

        if ($search = request('search')) {
            $query->where(function ($q) use ($search) {
                $q->whereUnaccentedLike('child_name', $search)
                    ->orWhereUnaccentedLike('phone', $search);
            });
        }

        if ($status = request('status')) {
            $query->where('status', $status);
        }

        if ($from = request('date_from')) {
            $query->whereDate('trial_date', '>=', $from);
        }

        if ($to = request('date_to')) {
            $query->whereDate('trial_date', '<=', $to);
        }

        $registrations = $query->paginate(20)->withQueryString();

        return view('admin.registration.index', compact('registrations'));
    }

    public function edit(Registration $registration)
    {
        $branches = Branch::active()->ordered()->get();
        $registration->load('branches');

        return view('admin.registration._form', compact('registration', 'branches'));
    }

    public function update(RegistrationRequest $request, Registration $registration)
    {
        $registration->update($request->validated());
        $registration->branches()->sync($request->input('branches', []));

        return redirect()->route('admin.registration.index')->with('success', 'Cập nhật đăng ký thành công.');
    }

    public function destroy(Registration $registration)
    {
        $registration->delete();

        return redirect()->route('admin.registration.index')->with('success', 'Xóa đăng ký thành công.');
    }
}
