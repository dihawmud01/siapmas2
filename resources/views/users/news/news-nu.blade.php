@section('title')
    {{ __('News') }}
@endsection

@extends('users.layout')

@section('content')
    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col-lg-8">
                <article class="my-5">
                    <header class="mb-4">
                        <figure class="mb-4">
                            <img class="img-fluid rounded" src="{{ $full }}" alt="{{ $title }}" />
                        </figure>

                        <h1 class="fw-bolder mb-1">{{ $title }}</h1>

                        <div class="text-muted my-2">
                            <i class="bi bi-clock"></i>
                            {{ $date }}
                            <i class="bi bi-person-fill mx-2">{{ __('Diunggah oleh:') }} {{ $author }}</i>
                            <i class="bi bi-info-square">{{ __('Sumber:') }}</i>
                            <a href="https://www.nu.or.id/">{{ __('NuOnline') }}</a>
                        </div>
                    </header>

                    <section class="mb-5">
                        <div class="card bg-light">
                            <div class="card-body" style="color: black">
                                <p class="fs-5 mb-4" style="color: #222222">
                                    {{ $preview }}
                                </p>
                                <a href="{{ $url }}">
                                    <div class="p-4 text-center">
                                        <h5>{{ __(' Baca Selengkapnya...') }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </section>
                </article>
            </div>

            <div class="col-lg-4">
                <div class="mb-3">
                    <div class="section-title mb-0">
                        <h4 class="text-uppercase font-weight-bold m-0">{{ __('NuOnline') }}</h4>
                    </div>
                    <div class="border-top-0 border bg-white p-3">
                        @foreach (array_slice($data['users'], 0, 6) as $nuOnline)
                            <div class="d-flex align-items-center mb-3 bg-white" style="height: 110px">
                                @if (isset($nuOnline['image']['thumbnail']))
                                    <img
                                        class="img-fluid"
                                        src="{{ $nuOnline['image']['thumbnail'] }}"
                                        alt="{{ __('Thumbnail') }}"
                                        style="height: 100px; width: 150px; overflow: hidden; object-fit: cover"
                                    />
                                @endif

                                <div
                                    class="w-100 h-100 d-flex flex-column justify-content-center border-left-0 border px-3"
                                >
                                    <div class="">
                                        <a
                                            class="badge badge-primary text-uppercase font-weight-semi-bold mr-2 pt-1"
                                            href="{{ route('news.nu', ['slug' => $nuOnline['slug']]) }}"
                                        >
                                            {{ $nuOnline['categories']['name'] }}
                                        </a>
                                    </div>
                                    <a
                                        class="h6 text-secondary font-weight-bold m-0"
                                        href="{{ route('news.nu', ['slug' => $nuOnline['slug']]) }}"
                                    >
                                        {{ Str::limit($nuOnline['title'], 30) }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
