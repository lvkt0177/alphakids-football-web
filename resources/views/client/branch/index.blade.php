@extends('layouts.client', ['title' => 'Hệ thống cơ sở'])

@section('content')
    <section class="section">
        <div class="container">
            <h1>Nhiều Cơ Sở Hiện Đại Gần Bạn</h1>
            <p>Nội dung trang Hệ thống cơ sở (mục F1–F4) sẽ được xây dựng ở bước tiếp theo.</p>

            @if ($branches->isNotEmpty())
                <ul>
                    @foreach ($branches as $branch)
                        <li>{{ $branch->name }} — {{ $branch->address }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </section>
@endsection