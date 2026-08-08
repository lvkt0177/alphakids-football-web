@extends('layouts.admin')

@section('title', 'Hoạt động & Sự kiện')
@section('page-title', 'Hoạt động & Sự kiện')
@section('page-desc', 'Quản lý danh sách hoạt động hiển thị ở trang Hoạt động & Sự kiện.')

@section('content')
    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title">Danh sách hoạt động</div>
                <div class="card-subtitle">{{ $activities->total() }} hoạt động</div>
            </div>
            <a href="{{ route('admin.activity.create') }}" class="btn btn-primary btn-sm">Thêm hoạt động</a>
        </div>

        <div class="table-scroll">
            <table>
                <thead>
                    <tr>
                        <th>Tên hoạt động</th>
                        <th>Danh mục</th>
                        <th>Nổi bật</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($activities as $activity)
                        <tr>
                            <td>{{ $activity->name }}</td>
                            <td>{{ $activity->category->getLabel() }}</td>
                            <td>
                                @if ($activity->is_featured)
                                    <span class="badge badge-purple">Nổi bật #{{ $activity->featured_order }}</span>
                                @else
                                    <span class="badge badge-gray">Không</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-{{ $activity->is_active ? 'green' : 'gray' }}">
                                    {{ $activity->is_active ? 'Hoạt động' : 'Tạm ẩn' }}
                                </span>
                            </td>
                            <td class="cell-actions">
                                <a href="{{ route('admin.activity.edit', $activity) }}"
                                    class="btn btn-secondary btn-sm">Sửa</a>
                                <form method="POST" action="{{ route('admin.activity.destroy', $activity) }}"
                                    data-confirm="Bạn chắc chắn muốn xóa hoạt động &quot;{{ $activity->name }}&quot;? Hành động này không thể hoàn tác."
                                    data-confirm-title="Xóa hoạt động" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr class="empty-row">
                            <td colspan="5">Chưa có hoạt động nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="table-footer">
            {{ $activities->links() }}
        </div>
    </div>
@endsection
