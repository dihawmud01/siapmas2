@section('title')
    {{ 'PAC' }}
@endsection

@extends('admins.layout')

@section('content')
    <div class="card info-card sales-card">
        <div class="container">
            <h2 class="my-2 text-center">{{ __('Data PAC') }}</h2>
            <div class="col-12 col-sm-8 col- md-6 my-3">
                <form action="{{ route('pac.update', $pac->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="pac" class="form-label">{{ __('Nama PAC') }}</label>
                        <input
                            type="text"
                            name="pac"
                            class="form-control mb-3"
                            id="pac"
                            required
                            value="{{ $pac['pac'] }}"
                        />
                    </div>

                    <div class="mb-3">
                        <a href="{{ route('pac.index') }}" class="btn btn-warning btn-sm">{{ __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary btn-sm">{{ __('Simpan') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
