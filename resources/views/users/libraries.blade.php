@section('title')
    {{ __('Perpustakaan') }}
@endsection

@extends('users.layout')

@section('content')
    <div class="my-5 pt-3 text-center">
        <h4 class="pt-5">{{ __('Perpustakaan Kader') }}</h4>
        <div class="card info-card sales-card container mt-5">
            <div class="col-12 col-sm-8 col-md-6 my-4">
                <form action="" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="search" placeholder="{{ __('Cari.....') }}" />
                        <button class="btn btn-primary">{{ __('Search') }}</button>
                    </div>
                </form>
            </div>

            <div class="row" style="margin-left: 0">
                @foreach ($libraries as $library)
                    <div
                        class="col-md-2 bg-body-tertiary mx-2 my-3 mb-5 rounded p-3 shadow"
                        style="width: 180px; height: 290px; object-fit: cover; margin-right: 0; position: relative"
                    >
                        <div>
                            <img
                                src="{{ asset('storage/images/' . $library['image']) }}"
                                style="
                                    width: 100%;
                                    height: 200px;
                                    object-fit: cover;
                                    border-radius: 20px;
                                    box-shadow: 0 0 5px 0 rgba(0, 0, 5, 10);
                                "
                                alt="{{ $library->title }}"
                            />
                        </div>
                        <div class="mt-3 text-center" style="position: absolute; bottom: 10px; left: 0; right: 0">
                            <span>{{ Str::limit($library->title, 15) }}</span>
                            <a
                                href="{{ route('libraries.details', ['id' => $library->id]) }}"
                                class="btn btn-outline-secondary btn-sm"
                                style="
                                    --bs-btn-padding-y: 0.25rem;
                                    --bs-btn-padding-x: 0.5rem;
                                    --bs-btn-font-size: 0.75rem;
                                    border-radius: 10px;
                                "
                            >
                                {{ __('Detail') }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
