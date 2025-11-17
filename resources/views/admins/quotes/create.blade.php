@section('title')
    {{ __('Quote') }}
@endsection

@extends('admins.layout')

@section('content')
    <div class="card info-card sales-card">
        <div class="container">
            <h4 class="mb-2 mt-5 text-center">{{ __('Tambah Quote') }}</h4>
            <form action="{{ route('quotes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="my-3">
                    <label for="img">{{ __('Gambar Tokoh') }}</label>
                    <input type="file" class="form-control my-4" name="img" id="img" required />
                </div>

                <div class="my-3">
                    <label for="name">{{ __('Nama Tokoh') }}</label>
                    <input type="text" class="form-control" name="name" id="name" required />
                </div>

                <div class="my-3">
                    <label for="who">{{ __('Jabatan/Status/Peran Tokoh') }}</label>
                    <input
                        type="text"
                        class="form-control"
                        name="who"
                        id="who"
                        placeholder="{{ __('ex:Pahlawan Nasional / ketua PC IPNU IPPNU Banyumas 2025') }}"
                        required
                    />
                </div>

                <div class="my-3">
                    <label for="quote">{{ __('Quote/Kata-kata') }}</label>
                    <textarea
                        class="form-control"
                        id="floatingTextarea2"
                        name="quote"
                        style="height: 100px"
                        required
                    ></textarea>
                </div>

                <div class="my-3">
                    <a href="{{ route('quotes.index') }}" class="btn btn-warning btn-sm">{{ __('Kembali') }}</a>
                    <button type="submit" class="btn btn-primary btn-sm mx-3">{{ __('Simpan') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
