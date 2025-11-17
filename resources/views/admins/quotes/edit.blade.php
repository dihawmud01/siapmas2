@section('title')
    {{ __('Quote') }}
@endsection

@extends('admins.layout')

@section('content')
    <div class="card info-card sales-card">
        <div class="container">
            <h4 class="mb-2 mt-5 text-center">{{ __('Edit Quote') }}</h4>
            <div class="row">
                <div class="col-lg-8">
                    <form
                        action="{{ route('quotes.update', ['id' => $quote->id]) }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >
                        @method('PUT')
                        @csrf
                        <div class="my-3">
                            <label for="img">{{ __('Gambar Tokoh') }}</label>
                            <input type="file" class="form-control my-4" name="img" id="img" />
                        </div>

                        <div class="my-3">
                            <label for="name">{{ __('Nama Tokoh') }}</label>
                            <input
                                type="text"
                                class="form-control"
                                name="name"
                                id="name"
                                value="{{ $quote->name }}"
                            />
                        </div>

                        <div class="my-3">
                            <label for="who">{{ __('Jabatan/Status/Peran Tokoh') }}</label>
                            <input
                                type="text"
                                class="form-control"
                                name="who"
                                id="who"
                                placeholder="{{ __('ex:Pahlawan Nasional / Ketua PC IPNU IPPNU Banyumas 2025') }}"
                                value="{{ $quote->who }}"
                            />
                        </div>

                        <div class="my-3">
                            <label for="quote">{{ __('Quote/Kata-kata') }}</label>
                            <textarea class="form-control" id="floatingTextarea2" name="quote" style="height: 100px">
{{ $quote->quote }}</textarea
                            >
                        </div>

                        <div class="my-3">
                            <a href="{{ route('quotes.index') }}" class="btn btn-warning btn-sm">
                                {{ __('Kembali') }}
                            </a>
                            <button type="submit" class="btn btn-primary btn-sm mx-3">{{ __('Simpan') }}</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="text-center">
                        <img
                            class="pt-4"
                            src="{{ asset('storage/images/' . $quote->img) }}"
                            alt="{{ __('Tokoh') }}"
                            style="width: 300px; height: 300px; object-fit: contain"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
