@section('title')
    {{ __('Halaman') }}
@endsection

@extends('admins.layout')

@section('content')
    <div class="card info-card sales-card">
        <div class="container">
            <h2 class="my-5 text-center">{{ __('Edit Gambar Utama') }}</h2>
            <form
                action="{{ route('pages.update', ['id' => $pages->id]) }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">{{ __('Judul') }}</label>
                    <input
                        type="text"
                        name="title"
                        class="form-control mb-3"
                        id="title"
                        value="{{ $pages->title }}"
                        required
                    />
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">{{ __('Deskripsi') }}</label>
                    <input
                        type="textarea"
                        class="form-control"
                        name="description"
                        id="description"
                        value="{{ $pages->description }}"
                    />
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('Gambar Saat Ini') }}</label>
                    <img src="{{ asset('storage/images/' . $pages->img) }}" class="img-thumbnail" width="3000" />
                </div>

                <div class="mb-3">
                    <label for="img" class="form-label">{{ __('Pilih Gambar Terbaru') }}</label>
                    <input name="img" class="form-control" type="file" id="img" value="{{ $pages->img }}" required />
                </div>
                <div class="my-3">
                    <a href="{{ route('pages.index') }}" class="btn btn-warning btn-sm">{{ __('Kembali') }}</a>
                    <button type="submit" class="btn btn-primary btn-sm">{{ __('Update') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
