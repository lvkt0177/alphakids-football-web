@extends('layouts.admin')

@section('title', 'Hệ thống cơ sở')
@section('page-title', 'Hệ thống cơ sở')
@section('page-desc', 'Quản lý danh sách cơ sở hiển thị ở trang Hệ thống cơ sở.')

@section('content')
    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title">Danh sách cơ sở</div>
                <div class="card-subtitle">{{ $branches->total() }} cơ sở</div>
            </div>
            <a href="{{ route('admin.branch.create') }}" class="btn btn-primary btn-sm">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
                Thêm cơ sở
            </a>
        </div>

        <div class="table-scroll">
            <table>
                <thead>
                    <tr>
                        <th>Tên cơ sở</th>
                        <th>Địa chỉ</th>
                        <th>Lịch học</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($branches as $branch)
                        <tr>
                            <td class="cell-name">{{ $branch->name }}</td>
                            <td>{{ $branch->address }}</td>
                            <td class="cell-mono">{{ $branch->schedule_weekday }} / {{ $branch->schedule_weekend }}</td>
                            <td>
                                <span class="badge badge-{{ $branch->is_active ? 'green' : 'gray' }}">
                                    {{ $branch->is_active ? 'Đang hoạt động' : 'Tạm ẩn' }}
                                </span>
                            </td>
                            <td class="cell-actions">
                                <a href="{{ route('admin.branch.edit', $branch) }}" class="btn btn-secondary btn-sm">Sửa</a>
                                <form method="POST" action="{{ route('admin.branch.destroy', $branch) }}"
                                    data-confirm="Bạn chắc chắn muốn xóa cơ sở &quot;{{ $branch->name }}&quot;? Hành động này không thể hoàn tác."
                                    data-confirm-title="Xóa cơ sở" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr class="empty-row">
                            <td colspan="5">
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-6.1-7-11.5A7 7 0 0 1 19 9.5C19 14.9 12 21 12 21Z"/><circle cx="12" cy="9.5" r="2.4"/></svg>
                                    </div>
                                    <div class="empty-state-title">Chưa có cơ sở nào</div>
                                    <div class="empty-state-desc">Thêm cơ sở đầu tiên để hiển thị ở trang Hệ thống cơ sở.</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="table-footer">
            {{ $branches->links() }}
        </div>
    </div>
@endsection