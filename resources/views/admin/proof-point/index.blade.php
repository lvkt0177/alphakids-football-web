@extends('layouts.admin')

@section('title', 'Vì sao phụ huynh chọn Alpha Kids')
@section('page-title', 'Vì sao phụ huynh chọn Alpha Kids')
@section('page-desc', 'Quản lý các trích dẫn cảm nhận từ phụ huynh, hiển thị ở mục "Vì sao phụ huynh chọn Alpha Kids" trên Trang chủ.')

@section('content')
    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title">Danh sách nội dung</div>
                <div class="card-subtitle">{{ $proofPoints->total() }} mục</div>
            </div>
            <a href="{{ route('admin.proof-point.create') }}" class="btn btn-primary btn-sm">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
                Thêm nội dung
            </a>
        </div>

        <div class="table-scroll">
            <table>
                <thead>
                    <tr>
                        <th>Tên phụ huynh</th>
                        <th>Trích dẫn</th>
                        <th>Thứ tự</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($proofPoints as $proofPoint)
                        <tr>
                            <td class="cell-name">{{ $proofPoint->author_name }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($proofPoint->description, 60) }}</td>
                            <td>{{ $proofPoint->sort_order }}</td>
                            <td>
                                <span class="badge badge-{{ $proofPoint->is_active ? 'green' : 'gray' }}">
                                    {{ $proofPoint->is_active ? 'Hiển thị' : 'Tạm ẩn' }}
                                </span>
                            </td>
                            <td class="cell-actions">
                                <a href="{{ route('admin.proof-point.edit', $proofPoint) }}"
                                    class="btn btn-secondary btn-sm">Sửa</a>
                                <form method="POST" action="{{ route('admin.proof-point.destroy', $proofPoint) }}"
                                    data-confirm="Bạn chắc chắn muốn xóa trích dẫn của &quot;{{ $proofPoint->author_name }}&quot;? Hành động này không thể hoàn tác."
                                    data-confirm-title="Xóa nội dung" style="display:inline;">
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
                                    <div class="empty-state-title">Chưa có nội dung nào</div>
                                    <div class="empty-state-desc">Thêm nội dung đầu tiên để hiển thị ở mục "Vì sao phụ huynh chọn Alpha Kids" trên Trang chủ.</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="table-footer">
            {{ $proofPoints->links() }}
        </div>
    </div>
@endsection
