@extends('layouts.admin')

@section('title', 'Đăng ký học thử')
@section('page-title', 'Đăng ký học thử')
@section('page-desc', 'Danh sách phụ huynh đã đăng ký học thử từ website.')

@section('content')
    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title">Danh sách đăng ký</div>
                <div class="card-subtitle">{{ $registrations->total() }} kết quả</div>
            </div>
        </div>

        <div class="table-scroll">
            <table>
                <thead>
                    <tr>
                        <th>Tên bé</th>
                        <th>Năm sinh</th>
                        <th>SĐT</th>
                        <th>Ngày trải nghiệm</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($registrations as $registration)
                        <tr>
                            <td>{{ $registration->child_name }}</td>
                            <td>{{ $registration->birth_year }}</td>
                            <td class="cell-mono">{{ $registration->phone }}</td>
                            <td class="cell-mono">{{ $registration->trial_date?->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge badge-{{ $registration->status->getBadge() }}">
                                    {{ $registration->status->getLabel() }}
                                </span>
                            </td>
                            <td class="cell-actions">
                                <a href="{{ route('admin.registration.edit', $registration) }}"
                                    class="btn btn-secondary btn-sm">Sửa</a>
                            </td>
                        </tr>
                    @empty
                        <tr class="empty-row">
                            <td colspan="6">Chưa có đăng ký nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="table-footer">
            {{ $registrations->links() }}
        </div>
    </div>
@endsection
