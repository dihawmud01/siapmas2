@section('title')
    {{ __('Pengurus') }}
@endsection

@extends('admins.layout')

@section('content')
    <div class="card info-card sales-card">
        <div class="container">
            <h4 class="mb-2 mt-5 text-center">{{ __('Tambah Pengurus') }}</h4>
            <form action="{{ route('administrators.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="my-3">
                    <label for="img">{{ __('Foto Pengurus') }}</label>
                    <input type="file" class="form-control my-4" name="img" id="img" required />
                </div>

                <div class="my-3">
                    <label for="name">{{ __('Nama') }}</label>
                    <input type="text" class="form-control" name="name" id="name" required />
                </div>

                <div class="my-3">
                    <label for="position">{{ __('Jabatan') }}</label>
                    <input type="text" class="form-control" name="position" id="position" required />
                </div>

                <div class="my-3">
                    <label for="ig">{{ __('Tautan Profil Instagram') }}</label>
                    <input type="text" class="form-control" name="ig" id="ig" />
                </div>

                <div class="my-3">
                    <label for="fb">{{ __('Tautan Profil Facebook') }}</label>
                    <input type="text" class="form-control" name="fb" id="fb" />
                </div>

                <div class="my-3">
                    <label for="x">{{ __('Tautan Profil X') }}</label>
                    <input type="text" class="form-control" name="x" id="x" />
                </div>

                <div class="my-3">
                    <a href="{{ route('administrators.index') }}" class="btn btn-warning btn-sm">
                        {{ __('Kembali') }}
                    </a>
                    <button type="submit" class="btn btn-primary btn-sm mx-3">{{ __('Simpan') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
