@extends('layouts.admin')

@section('title', 'Câu hỏi thường gặp')
@section('page-title', 'Câu hỏi thường gặp (FAQ)')

@section('content')
    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title">Danh sách câu hỏi</div>
                <div class="card-subtitle">{{ $faqs->total() }} câu hỏi</div>
            </div>
            <a href="{{ route('admin.faq.create') }}" class="btn btn-primary btn-sm">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
                Thêm câu hỏi
            </a>
        </div>

        <div class="table-scroll">
            <table>
                <thead>
                    <tr>
                        <th>Câu hỏi</th>
                        <th>Trang chủ</th>
                        <th>Thứ tự</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($faqs as $faq)
                        <tr>
                            <td class="cell-name">{{ $faq->question }}</td>
                            <td>
                                <span class="badge badge-{{ $faq->show_on_home ? 'featured' : 'gray' }}">
                                    {{ $faq->show_on_home ? 'Có hiển thị' : 'Không' }}
                                </span>
                            </td>
                            <td>{{ $faq->sort_order }}</td>
                            <td>
                                <span class="badge badge-{{ $faq->is_active ? 'green' : 'gray' }}">
                                    {{ $faq->is_active ? 'Hiển thị' : 'Tạm ẩn' }}
                                </span>
                            </td>
                            <td class="cell-actions">
                                <a href="{{ route('admin.faq.edit', $faq) }}" class="btn btn-secondary btn-sm">Sửa</a>
                                <form method="POST" action="{{ route('admin.faq.destroy', $faq) }}"
                                    data-confirm="Bạn chắc chắn muốn xóa câu hỏi &quot;{{ $faq->question }}&quot;? Hành động này không thể hoàn tác."
                                    data-confirm-title="Xóa câu hỏi" style="display:inline;">
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
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M9.5 9a2.5 2.5 0 0 1 5 0c0 1.5-2 2-2 3.5"/><path d="M12 17h.01"/></svg>
                                    </div>
                                    <div class="empty-state-title">Chưa có câu hỏi nào</div>
                                    <div class="empty-state-desc">Thêm câu hỏi đầu tiên để hiển thị ở trang FAQ và Trang chủ.</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="table-footer">
            {{ $faqs->links() }}
        </div>
    </div>
@endsection
