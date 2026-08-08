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
            <a href="{{ route('admin.branch.create') }}" class="btn btn-primary btn-sm">Thêm cơ sở</a>
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
                            <td>{{ $branch->name }}</td>
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
                            <td colspan="5">Chưa có cơ sở nào.</td>
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
