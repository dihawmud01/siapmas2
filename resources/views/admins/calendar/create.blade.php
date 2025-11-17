@section('title')
    {{ __('Agenda') }}
@endsection

@extends('admins.layout')

@section('content')
    <div class="card info-card sales-card">
        <div class="container">
            <h2 class="my-2 text-center">{{ __('Tambah Agenda') }}</h2>

            <div class="col-12 col-sm-8 col-md-6 my-3">
                <form action="{{ route('admin.calendar.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">{{ __('Nama Kegiatan') }}</label>
                        <input type="text" name="title" class="form-control mb-3" id="title" required />
                    </div>
                    <div class="mb-3">
                        <label for="organizer" class="form-label">{{ __('Penyelenggara') }}</label>
                        <select name="organizer" class="form-select" required aria-label="organizer">
                            <option disabled selected>{{ __('-- Pilih --') }}</option>
                            @foreach ($organizers as $organizer)
                                <option
                                    value="{{ $organizer }}"
                                    {{ old('organizer') == $organizer ? 'selected' : '' }}
                                >
                                    {{ $organizer }}
                                </option>
                            @endforeach
                        </select>
                        <br />
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">{{ __('Waktu') }}</label>
                        <input type="datetime-local" name="date" class="form-control mb-3" id="date" required />
                    </div>
                    <div class="mb-3">
                        <label for="place" class="form-label">{{ __('Tempat') }}</label>
                        <input type="text" name="place" class="form-control mb-3" id="place" required />
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">{{ __('Kategori Kegiatan') }}</label>
                        <select name="category" class="form-select" required aria-label="category">
                            <option disabled selected>{{ __('-- Pilih --') }}</option>
                            @foreach ($categories as $value => $label)
                                <option value="{{ $value }}" {{ old('category') == $value ? 'selected' : '' }}>
                                    {{ __($label) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="pamphlet" class="form-label">{{ __('Pamflet (Bila Ada)') }}</label>
                        <input type="file" name="pamphlet" class="form-control mb-3" id="pamphlet" />
                    </div>

                    <div class="mb-3">
                        <a href="{{ route('admin.calendar.index') }}" class="btn btn-warning btn-sm">
                            {{ __('Kembali') }}
                        </a>
                        <button type="submit" class="btn btn-primary btn-sm">{{ __('Simpan') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
