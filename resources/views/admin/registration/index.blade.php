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
                            <td class="cell-name">{{ $registration->child_name }}</td>
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
                            <td colspan="6">
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3.5" y="4" width="17" height="16" rx="2"/><path d="M7.5 9h9M7.5 13h9M7.5 17h5"/></svg>
                                    </div>
                                    <div class="empty-state-title">Chưa có đăng ký nào</div>
                                    <div class="empty-state-desc">Lượt đăng ký học thử mới từ website sẽ hiển thị ở đây.</div>
                                </div>
                            </td>
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