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
        $registrations = $this->filteredQuery()->paginate(20)->withQueryString();

        return view('admin.registration.index', compact('registrations'));
    }

    public function export()
    {
        $registrations = $this->filteredQuery()->get();

        $filename = 'dang-ky-hoc-thu-'.now()->format('Y-m-d-His').'.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($registrations) {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");

            fputcsv($handle, [
                'Tên bé', 'Cơ sở', 'Năm sinh', 'Giới tính', 'SĐT',
                'Ngày trải nghiệm', 'Ghi chú', 'Trạng thái', 'Ngày đăng ký',
            ]);

            foreach ($registrations as $registration) {
                fputcsv($handle, [
                    $registration->child_name,
                    $registration->branches->map(fn ($b) => $b->displayLocation() ?? $b->name)->implode(', '),
                    $registration->birth_year,
                    $registration->gender?->getLabel(),
                    $registration->phone,
                    $registration->trial_date?->format('d/m/Y'),
                    $registration->note,
                    $registration->status->getLabel(),
                    $registration->created_at->format('d/m/Y H:i'),
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    protected function filteredQuery()
    {
        $query = Registration::query()->with('branches')->latest();

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

        return $query;
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
