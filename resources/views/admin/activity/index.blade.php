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
            <a href="{{ route('admin.activity.create') }}" class="btn btn-primary btn-sm">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
                Thêm hoạt động
            </a>
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
                            <td class="cell-name">{{ $activity->name }}</td>
                            <td>{{ $activity->category->getLabel() }}</td>
                            <td>
                                @if ($activity->is_featured)
                                    <span class="badge badge-featured">Nổi bật #{{ $activity->featured_order }}</span>
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
                            <td colspan="5">
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 3v3M12 18v3M3 12h3M18 12h3"/><circle cx="12" cy="12" r="3"/></svg>
                                    </div>
                                    <div class="empty-state-title">Chưa có hoạt động nào</div>
                                    <div class="empty-state-desc">Thêm hoạt động đầu tiên để hiển thị ở trang Hoạt động &amp; Sự kiện.</div>
                                </div>
                            </td>
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