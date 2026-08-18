@extends('layouts.client', [
    'title' => 'Liên hệ & Đăng ký học thử',
    'description' => 'Đăng ký buổi học thử miễn phí tại Alpha Kids Football Club: điền thông tin, chọn cơ sở phù hợp, đội ngũ sẽ liên hệ lại sớm nhất trong ngày.',
])

@push('styles')
    <link rel="stylesheet"
        href="{{ asset('css/client/registration.css') }}?v={{ filemtime(public_path('css/client/registration.css')) }}">
@endpush

@section('content')
    <div class="registration-page">

        <section class="section section--padding-block-64" data-reveal-group>
            <div class="container">
                <div class="section-head section-head--center reveal">
                    <h1>Sẵn sàng cho <span class="hl">buổi học thử đầu tiên?</span></h1>
                    <p>Điền thông tin bên dưới, đội ngũ Alpha Kids sẽ gọi lại để xếp lịch phù hợp với bé.</p>
                </div>

                <div class="registration-wrap">

                    <div class="form-card reveal">
                        <div class="form-card__head">
                            <div class="icon-roundel">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <circle cx="12" cy="12" r="9" />
                                    <path d="M12 7v5l3.5 2" />
                                </svg>
                            </div>
                            <div>
                                <h2>Đăng ký học thử <span class="hl">miễn phí</span></h2>
                                <p>Vui lòng điền đầy đủ thông tin, chúng tôi sẽ liên hệ hỗ trợ bạn sớm nhất.</p>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('registration.store') }}">
                            @csrf

                            <div class="form-group reveal reveal-d1">
                                <span class="form-group__label">Thông tin của bé</span>

                                <div class="form-row">
                                    <div class="field">
                                        <label for="child_name">Họ và tên bé <span>*</span></label>
                                        <input type="text" id="child_name" name="child_name"
                                            value="{{ old('child_name') }}" placeholder="Nhập họ và tên bé">
                                        @error('child_name')
                                            <p class="field-error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="field">
                                        <label for="birth_year">Năm sinh <span>*</span></label>
                                        <div class="select" data-select>
                                            <select id="birth_year" name="birth_year">
                                                <option value="">Chọn năm sinh</option>
                                                @for ($y = date('Y'); $y >= date('Y') - 15; $y--)
                                                    <option value="{{ $y }}"
                                                        {{ old('birth_year') == $y ? 'selected' : '' }}>{{ $y }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                        @error('birth_year')
                                            <p class="field-error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="field">
                                    <label>Giới tính <span>*</span></label>
                                    <div class="radio-row">
                                        @foreach (\App\Enums\Gender::cases() as $gender)
                                            <label class="radio">
                                                <input type="radio" name="gender" value="{{ $gender->value }}"
                                                    {{ old('gender') === $gender->value ? 'checked' : '' }}>
                                                {{ $gender->getLabel() }}
                                            </label>
                                        @endforeach
                                    </div>
                                    @error('gender')
                                        <p class="field-error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group form-group--divider reveal reveal-d2">
                                <span class="form-group__label">Liên hệ &amp; cơ sở</span>

                                <div class="field">
                                    <label for="phone">Số điện thoại <span>*</span></label>
                                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                        placeholder="Nhập số điện thoại">
                                    @error('phone')
                                        <p class="field-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="field">
                                    <label>Cơ sở đăng ký <span>*</span></label>
                                    <div class="check-grid">
                                        @foreach ($branches as $branch)
                                            <label class="check">
                                                <input type="checkbox" name="branches[]" value="{{ $branch->id }}"
                                                    {{ in_array($branch->id, old('branches', [])) ? 'checked' : '' }}>
                                                <span class="check__box">
                                                    <svg class="check__tick" viewBox="0 0 16 16" fill="none"
                                                        stroke="currentColor" stroke-width="2.3" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path d="M3.5 8.5l3 3 6-7" />
                                                    </svg>
                                                </span>
                                                {{ \Illuminate\Support\Str::title($branch->displayLocation() ?? $branch->name) }}
                                            </label>
                                        @endforeach
                                    </div>
                                    @error('branches')
                                        <p class="field-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="field">
                                    <label for="note">Ghi chú thêm</label>
                                    <textarea id="note" name="note" class="textarea"
                                        placeholder="Nhập nội dung bạn muốn chia sẻ thêm (nếu có)">{{ old('note') }}</textarea>
                                </div>
                            </div>

                            <button type="submit" class="btn btn--accent btn--block">
                                Đăng ký ngay
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14M13 6l6 6-6 6" />
                                </svg>
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </section>

    </div>
@endsection
