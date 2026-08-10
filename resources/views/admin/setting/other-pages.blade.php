@extends('layouts.admin')

@push('scripts')
    <script src="{{ asset('js/admin/setting.js') }}?v={{ filemtime(public_path('js/admin/setting.js')) }}"></script>
@endpush

@section('title', 'Nội dung trang khác')
@section('page-title', 'Nội dung trang khác')
@section('page-desc', 'Quản lý ảnh hiển thị ở các trang còn lại trên website.')

@section('content')
    <div class="tabs">
        @foreach (\App\Support\OtherPagesImageGroups::PAGES as $pageKey => $page)
            <button type="button" class="tab-btn {{ $loop->first ? 'active' : '' }}" data-tab="{{ $pageKey }}">
                {{ $page['label'] }}
            </button>
        @endforeach
    </div>

    @foreach (\App\Support\OtherPagesImageGroups::PAGES as $pageKey => $page)
        <div class="tab-panel {{ $loop->first ? 'active' : '' }}" id="tab-{{ $pageKey }}">
            <form class="card" method="POST" action="{{ route('admin.setting.other-pages.images.update') }}" enctype="multipart/form-data">
                @csrf

                <div class="card-header">
                    <div>
                        <div class="card-title">{{ $page['label'] }}</div>
                        <div class="card-subtitle">Quản lý ảnh hiển thị ở trang {{ $page['label'] }}.</div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7"/></svg>
                        Lưu ảnh
                    </button>
                </div>

                @foreach ($page['groups'] as $groupLabel => $keys)
                    <div class="image-group-title">{{ $groupLabel }}</div>
                    <div class="image-grid">
                        @foreach ($keys as $key => $label)
                            <div class="image-card">
                                <div class="image-preview">
                                    @if ($images[$key])
                                        <img src="{{ asset('storage/'.$images[$key]) }}" alt="{{ $label }}">
                                    @else
                                        <div class="image-placeholder">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="m3 16 5-5 4 4 5-5 4 4"/><circle cx="8.5" cy="9" r="1.4"/></svg>
                                            <span>Chưa có ảnh</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="image-card-body">
                                    <div class="image-card-label">{{ $label }}</div>
                                    <div class="btn btn-secondary btn-sm btn-file">
                                        <input type="file" name="images[{{ $key }}]" accept="image/*">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 15V3m0 0 4 4m-4-4-4 4"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2"/></svg>
                                        Chọn ảnh mới
                                    </div>
                                    @error('images.'.$key) <p class="field-error">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </form>
        </div>
    @endforeach
@endsection