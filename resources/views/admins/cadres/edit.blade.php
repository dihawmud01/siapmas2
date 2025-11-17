@section('title')
    {{ __('Kader') }}
@endsection

@extends('admins.layout')

@section('content')
    <div class="card info-card sales-card">
        <div class="container">
            <h4 class="mb-2 mt-5 text-center">{{ __('Edit Anggota Kader') }}</h4>
            @if (Session::flash('update'))
                <div class="alert alert-primary" role="alert">{{ __('Mantap sahabat!!! Kader Berhasil Diubah') }}</div>
            @endif

            <form
                action="{{ route('cadre.update', ['id' => $cadre->id]) }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Nama Lengkap') }}</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control mb-3"
                        id="name"
                        value="{{ $cadre->name }}"
                        required
                    />
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">{{ __('Alamat Lengkap') }}</label>
                    <input
                        type="textarea"
                        name="address"
                        class="form-control mb-3"
                        id="address"
                        value="{{ $cadre->address }}"
                    />
                </div>

                <div class="mb-3">
                    <label for="nim" class="form-label">{{ __('Nomor Induk Mahasiswa (NIM)') }}</label>
                    <input type="text" class="form-control mb-3" name="nim" id="nim" value="{{ $cadre->nim }}" />
                </div>

                <div class="mb-3">
                    <label for="gender">{{ __('Jenis Kelamin') }}</label>
                    <select name="gender" class="form-select" aria-label="{{ __('Jenis Kelamin') }}">
                        <option disabled selected>{{ __('-- Pilih --') }}</option>
                        @foreach ($genders as $value => $label)
                            <option value="{{ $value }}" {{ $cadre->gender == $value ? 'selected' : '' }}>
                                {{ __($label) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="place" class="form-label">{{ __('Tempat Lahir') }}</label>
                    <input
                        type="text"
                        class="form-control"
                        name="place"
                        id="place"
                        value="{{ $cadre->place_of_birth }}"
                    />
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('Foto Profil') }}</label>
                    <img
                        src="{{ asset('storage/uploads/' . $cadre['photo']) }}"
                        class="img-thumbnail"
                        width="150"
                        alt="{{ __('Foto Profil') }}"
                    />
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label">{{ __('Pilih Foto') }}</label>
                    <input name="photo" class="form-control" type="file" id="photo" value="{{ $cadre->photo }}" />
                </div>

                <div class="my-3">
                    <a href="{{ route('cadres.index') }}" class="btn btn-warning btn-sm">{{ __('Kembali') }}</a>
                    <button type="submit" class="btn btn-primary btn-sm">{{ __('Update') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
