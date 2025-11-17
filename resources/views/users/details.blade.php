@section('title')
    {{ __('Buku') }}
@endsection

@extends('users.layout')
@section('content')
    <div class="my-5 pt-3 text-center">
        <h4 class="pt-5">{{ __('Perpustakaan Kader') }}</h4>
        <div class="card info-card sales-card container mt-5">
            <div class="row" style="margin-left: 0">
                <div class="row">
                    <div class="col p-5 text-start">
                        <h2 class="mt-4 pt-4">{{ $library->title }}</h2>
                        <div class="movie-summary"></div>
                        <dl class="row pt-5">
                            <dt class="col-sm-3">{{ __('Judul') }}</dt>
                            <dd class="col-sm-9">{{ $library->title }}</dd>
                            <dt class="col-sm-3">{{ __('Penulis') }}</dt>
                            <dd class="col-sm-9">{{ $library->author }}</dd>
                            <dt class="col-sm-3">{{ __('Tahun Terbit') }}</dt>
                            <dd class="col-sm-9">{{ $library->year }}</dd>
                            <dt class="col-sm-3">{{ __('Halaman') }}</dt>
                            <dd class="col-sm-9">{{ $library->pages }}</dd>
                            <dt class="col-sm-3">{{ __('ISBN') }}</dt>
                            <dd class="col-sm-9">{{ $library->isbn }}</dd>
                            <dt class="col-sm-3">{{ __('Category') }}</dt>
                            <dd class="col-sm-9">{{ $library->book_categories->title }}</dd>
                            <dt class="col-sm-3 text-truncate">{{ __('Deskripsi') }}</dt>
                            <dd class="col-sm-9">{{ $library->description }}</dd>
                        </dl>
                    </div>
                    <div class="col mt-5">
                        <figure class="movie-poster">
                            <img
                                width="300"
                                src="{{ asset('storage/images/' . $library->img) }}"
                                alt="#"
                                style="box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.6)"
                            />
                        </figure>
                        <div class="pb-5 text-center">
                            <a
                                href="{{ route('libraries.index') }}"
                                class="btn btn-warning btn-sm"
                                style="
                                    --bs-btn-padding-y: 0.25rem;
                                    --bs-btn-padding-x: 0.5rem;
                                    --bs-btn-font-size: 0.75rem;
                                    border-radius: 10px;
                                    margin-left: 5px;
                                "
                            >
                                {{ __('Kembali') }}
                            </a>
                            <a
                                href="{{ asset('storage/pdf/' . $library['pdf']) }}"
                                download
                                type="button"
                                class="btn btn-secondary btn-sm"
                                style="
                                    --bs-btn-padding-y: 0.25rem;
                                    --bs-btn-padding-x: 0.5rem;
                                    --bs-btn-font-size: 0.75rem;
                                    border-radius: 10px;
                                    margin-left: 5px;
                                "
                            >
                                {{ __('Download') }}
                            </a>
                            <a
                                href="{{ asset('storage/pdf/' . $library['pdf']) }}"
                                type="button"
                                class="btn btn-success btn-sm"
                                style="
                                    --bs-btn-padding-y: 0.25rem;
                                    --bs-btn-padding-x: 0.5rem;
                                    --bs-btn-font-size: 0.75rem;
                                    border-radius: 10px;
                                    margin-left: 5px;
                                "
                            >
                                {{ __('Baca') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
