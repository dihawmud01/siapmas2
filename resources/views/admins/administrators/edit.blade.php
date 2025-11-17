@section('title')
    {{ __('Pengurus') }}
@endsection

@extends('admins.layout')

@section('content')
    <div class="card info-card sales-card">
        <div class="container">
            <h4 class="mb-2 mt-5 text-center">{{ __('Edit Pengurus') }}</h4>
            <div class="row">
                <div class="col-lg-8">
                    <form
                        action="{{ route('administrators.update', ['id' => $administrator->id]) }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >
                        @method('PUT')
                        @csrf
                        <div class="my-3">
                            <label for="img">{{ __('Foto Pengurus') }}</label>
                            <input
                                type="file"
                                class="form-control my-4"
                                name="img"
                                id="img"
                                value="{{ $administrator->img }}"
                            />
                        </div>

                        <div class="my-3">
                            <label for="name">{{ __('Nama') }}</label>
                            <input
                                type="text"
                                class="form-control"
                                name="name"
                                id="name"
                                value="{{ $administrator->name }}"
                            />
                        </div>

                        <div class="my-3">
                            <label for="position">{{ __('Jabatan') }}</label>
                            <input
                                type="text"
                                class="form-control"
                                name="position"
                                id="position"
                                value="{{ $administrator->position }}"
                            />
                        </div>

                        <div class="my-3">
                            <label for="ig">{{ __('Tutan Profil Instagram') }}</label>
                            <input
                                type="text"
                                class="form-control"
                                name="ig"
                                id="ig"
                                value="{{ $administrator->ig }}"
                            />
                        </div>

                        <div class="my-3">
                            <label for="fb">{{ __('Tutan Profil Facebook') }}</label>
                            <input
                                type="text"
                                class="form-control"
                                name="fb"
                                id="fb"
                                value="{{ $administrator->fb }}"
                            />
                        </div>

                        <div class="my-3">
                            <label for="x">{{ __('Tutan Profil X') }}</label>
                            <input type="text" class="form-control" name="x" id="x" value="{{ $administrator->x }}" />
                        </div>

                        <div class="my-3">
                            <a href="{{ route('administrators.index') }}" class="btn btn-warning btn-sm">
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
                            src="{{ asset('storage/images/' . $administrator->img) }}"
                            alt="img"
                            style="width: 300px; height: 300px; object-fit: contain"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
