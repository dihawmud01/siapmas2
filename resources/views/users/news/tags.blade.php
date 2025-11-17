@section('title')
    {{ __('Tag') }}
@endsection

@extends('users.layout')

@push('style')
    @vite('resources/css/news.css')
@endpush

@section('content')
    <div class="container-fluid news-container">
        <div class="container my-5 pt-5">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-title mb-4 rounded">
                        <h4 class="text-uppercase font-weight-bold m-0">
                            {{ __('Berita berdasarkan hashtag') }} "#{{ $tag->title }}"
                        </h4>
                    </div>

                    <div class="row g-3">
                        @foreach ($news as $post)
                            <div class="col-md-6">
                                <div class="card h-100 rounded">
                                    <div class="d-flex">
                                        @if ($post->img)
                                            <img
                                                class="img-fluid rounded-start h-100"
                                                src="{{ asset('storage/images/' . $post->img) }}"
                                                alt="{{ $post->category->title }}"
                                                style="width: 150px; object-fit: cover"
                                            />
                                        @endif

                                        <div class="w-100 d-flex flex-column justify-content-between border-left p-3">
                                            <a
                                                class="badge badge-primary text-uppercase font-weight-semi-bold text-decoration-none mb-1 rounded p-2 text-white"
                                                href="{{ route('categories', $post->category->slug) }}"
                                                style="width: fit-content"
                                            >
                                                {{ __($post->category->title) }}
                                            </a>
                                            <a
                                                class="h6 text-dark fw-bold w-100 text-decoration-none mb-1"
                                                href="{{ route('news.show', ['slug' => $post->slug]) }}"
                                            >
                                                {{ __(Str::limit($post->title, 60)) }}
                                            </a>

                                            <small class="text-muted">
                                                {{ $post->formatted_date }}
                                            </small>
                                        </div>
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
@endsection
