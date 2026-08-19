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
            <a href="{{ route('admin.registration.export', request()->query()) }}" class="btn btn-secondary btn-sm">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v12m0 0l-4-4m4 4l4-4M5 21h14"/></svg>
                Xuất Excel
            </a>
        </div>

        <div class="table-scroll">
            <table class="table--fixed">
                <colgroup>
                    <col style="width:15%">
                    <col style="width:15%">
                    <col style="width:8%">
                    <col style="width:11%">
                    <col style="width:11%">
                    <col style="width:20%">
                    <col style="width:10%">
                    <col style="width:10%">
                </colgroup>
                <thead>
                    <tr>
                        <th>Tên bé</th>
                        <th>Cơ sở</th>
                        <th>Năm sinh</th>
                        <th>SĐT</th>
                        <th>Ngày trải nghiệm</th>
                        <th>Ghi chú</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($registrations as $registration)
                        <tr>
                            <td class="cell-name">
                                <span class="cell-truncate" title="{{ $registration->child_name }}">{{ $registration->child_name }}</span>
                            </td>
                            <td>
                                @if ($registration->branches->isNotEmpty())
                                    <span class="cell-truncate"
                                        title="{{ $registration->branches->map(fn ($b) => $b->displayLocation() ?? $b->name)->implode(', ') }}">
                                        {{ $registration->branches->map(fn ($b) => \Illuminate\Support\Str::title($b->displayLocation() ?? $b->name))->implode(', ') }}
                                    </span>
                                @else
                                    <span class="cell-empty">&mdash;</span>
                                @endif
                            </td>
                            <td>{{ $registration->birth_year }}</td>
                            <td class="cell-mono">{{ $registration->phone }}</td>
                            <td class="cell-mono">{{ $registration->trial_date?->format('d/m/Y') }}</td>
                            <td>
                                @if ($registration->note)
                                    <span class="cell-truncate" title="{{ $registration->note }}">{{ $registration->note }}</span>
                                @else
                                    <span class="cell-empty">&mdash;</span>
                                @endif
                            </td>
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
                            <td colspan="8">
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