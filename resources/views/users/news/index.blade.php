@section('title')
    {{ __('Berita') }}
@endsection

@extends('users.layout')

@push('script')
    @vite('resources/js/plugins/owl.carousel.js')
@endpush

@push('style')
    @vite('resources/css/news.css')
@endpush

@section('content')
    <div class="container-fluid news-container">
        <div class="row">
            <div class="col-lg-7 px-0">
                <div class="owl-carousel main-carousel position-relative">
                    @foreach ($recentNews->take(3) as $news)
                        <div class="position-relative overflow-hidden" style="height: 682px">
                            @if ($news->img)
                                <a href="{{ route('news.show', ['slug' => $news->slug]) }}">
                                    <img
                                        class="img-fluid h-100"
                                        src="{{ asset('storage/images/' . $news->img) }}"
                                        style="object-fit: cover"
                                        alt="{{ $news->title }}"
                                    />
                                </a>
                            @endif

                            <div class="overlay">
                                <div class="d-flex align-items-center mb-2 overflow-hidden">
                                    <a
                                        class="badge badge-primary text-uppercase font-weight-semi-bold text-decoration-none mr-2 p-2"
                                        href="{{ route('categories', ['slug' => $news->category->slug]) }}"
                                    >
                                        {{ $news->category->title }}
                                    </a>
                                    <h8 style="color: #fff">
                                        {{ $news->created_at->diffForHumans() }}
                                    </h8>
                                </div>
                                <a
                                    class="h3 font-weight-bold text-decoration-none m-0 text-white"
                                    href="{{ route('news.show', ['slug' => $news->slug]) }}"
                                >
                                    {{ $news->title }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-5 px-0">
                <div class="row mx-0">
                    @foreach ($trending->take(4) as $news)
                        <div class="col-md-6 px-0">
                            <div class="position-relative overflow-hidden" style="height: 341px">
                                @if ($news->img)
                                    <img
                                        class="img-fluid w-100 h-100"
                                        src="{{ asset('storage/images/' . $news->img) }}"
                                        style="object-fit: cover"
                                        alt="{{ $news->title }}"
                                    />
                                @endif

                                <div class="overlay">
                                    <div class="d-flex align-items-center mb-2">
                                        <a
                                            class="badge badge-warning text-uppercase font-weight-semi-bold text-decoration-none me-2 p-2"
                                            href="{{ route('categories', ['slug' => $news->category->slug]) }}"
                                        >
                                            {{ $news->category->title }}
                                        </a>
                                        <h9 style="color: #fff">
                                            {{ $news->created_at->diffForHumans() }}
                                        </h9>
                                    </div>
                                    <a
                                        class="h6 font-weight-semi-bold text-decoration-none m-0 text-white"
                                        href="{{ route('news.show', ['slug' => $news->slug]) }}"
                                    >
                                        {{ Str::limit($news->title, 84) }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid bg-dark mb-3 py-3">
        <div class="container my-3">
            <div class="row align-items-center bg-dark">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <div
                            class="bg-danger text-light font-weight-medium rounded py-2 text-center"
                            style="width: 170px"
                        >
                            {{ __('BERITA TERKINI!') }}
                        </div>
                        <div
                            class="owl-carousel tranding-carousel position-relative d-inline-flex align-items-center ml-3"
                            style="width: calc(100% - 200px); padding-right: 100px"
                        >
                            @foreach ($recentNews->take(2) as $news)
                                <div class="text-truncate">
                                    <a
                                        class="font-weight-semi-bold text-decoration-none text-white"
                                        href="{{ route('news.show', ['slug' => $news->slug]) }}"
                                    >
                                        {{ Str::limit($news->title, 50) }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mb-5 pt-5">
        <div class="container">
            <div class="section-title rounded">
                <h4 class="font-weight-bold m-0">{{ __('Berita Unggulan') }}</h4>
            </div>
            <div class="container mb-0 p-0">
                <div class="owl-carousel news-carousel carousel-item-4 position-relative">
                    @foreach ($oldNews->take(7) as $news)
                        <div class="position-relative overflow-hidden rounded" style="height: 300px">
                            @if ($news->img)
                                <img
                                    class="img-fluid h-100"
                                    src="{{ asset('storage/images/' . $news->img) }}"
                                    style="object-fit: cover"
                                    alt="{{ $news->category->title }}"
                                />
                            @endif

                            <div class="overlay">
                                <div class="d-flex align-items-center mb-2">
                                    <a
                                        class="badge badge-primary text-uppercase font-weight-semi-bold text-decoration-none mr-2 p-2"
                                        href="{{ route('categories', ['slug' => $news->category->slug]) }}"
                                    >
                                        {{ $news->category->title }}
                                    </a>
                                </div>
                                <a
                                    class="h6 font-weight-semi-bold text-decoration-none m-0 text-white"
                                    href="{{ route('news.show', ['slug' => $news->slug]) }}"
                                >
                                    {{ Str::limit($news->title, 50) }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="container-fluid my-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-12">
                                <div class="section-title rounded">
                                    <h4 class="font-weight-bold m-0">{{ __('Berita Terbaru') }}</h4>
                                    {{-- <a class="text-success font-weight-medium text-decoration-none" href=""> --}}
                                    {{-- {{ __('Lihat Semua') }} --}}
                                    {{-- </a> --}}
                                </div>
                            </div>

                            @foreach ($recentNews as $news)
                                <div class="col-lg-6">
                                    <div
                                        class="d-flex align-items-center mb-3 rounded border bg-white"
                                        style="height: 120px"
                                    >
                                        @if ($news->img)
                                            <img
                                                class="img-fluid rounded-start-1 h-100"
                                                src="{{ asset('storage/images/' . $news->img) }}"
                                                alt="{{ $news->title }}"
                                                style="width: 150px; overflow: hidden; object-fit: cover"
                                            />
                                        @endif

                                        <div
                                            class="w-100 h-100 d-flex flex-column justify-content-center border-left px-3"
                                        >
                                            <div class="mb-1">
                                                <a
                                                    class="badge badge-primary text-uppercase font-weight-semi-bold text-decoration-none me-2 p-2"
                                                    href="{{ route('categories', ['slug' => $news->category->slug]) }}"
                                                >
                                                    {{ $news->category->title }}
                                                </a>
                                            </div>
                                            <div class="mb-1">
                                                <a
                                                    class="h6 text-dark font-weight-bold text-decoration-none m-0"
                                                    href="{{ route('news.show', ['slug' => $news->slug]) }}"
                                                >
                                                    {{ Str::limit($news->title, 30) }}
                                                </a>
                                            </div>
                                            <h8 class="text-secondary">
                                                <small>
                                                    {{ $news->created_at->diffForHumans() }}
                                                </small>
                                            </h8>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @include('users.partials._sidebar')
                </div>
            </div>
        </div>
    </div>
@endsection
