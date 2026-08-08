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
                    <button type="submit" class="btn btn-primary btn-sm">Lưu ảnh</button>
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
                                        <div class="image-placeholder"><span>Chưa có ảnh</span></div>
                                    @endif
                                </div>
                                <div class="image-card-body">
                                    <div class="image-card-label">{{ $label }}</div>
                                    <div class="btn btn-secondary btn-sm btn-file">
                                        <input type="file" name="images[{{ $key }}]" accept="image/*">
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