@section('title')
    {{ __('Hari Besar') }}
@endsection

@extends('admins.layout')

@section('content')
    <div class="card info-card sales-card">
        <div class="container my-3">
            <h4 class="my-5">{{ __('Hari Besar Nasional') }}</h4>

            <form action="{{ route('hbn.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="my-3">
                    <label for="title">{{ __('Hari Besar') }}</label>
                    <input
                        type="text"
                        class="form-control my-4"
                        name="title"
                        id="title"
                        placeholder="ex:Idul Fitri"
                        required
                    />
                </div>

                <div class="my-3">
                    <label for="date">{{ __('Tanggal') }}</label>
                    <input
                        type="date"
                        class="form-control my-4"
                        name="date"
                        id="date"
                        placeholder="ex:2023-07-01"
                        required
                    />
                </div>

                <div class="my-3">
                    <label for="description">{{ __('Deskripsi') }}</label>
                    <textarea
                        name="description"
                        class="form-control my-4"
                        id="description"
                        placeholder="{{ __('Opsional') }}"
                        cols="30"
                        rows="3"
                    ></textarea>
                </div>

                <div class="my-3">
                    <a href="{{ route('hbn.index') }}" class="btn btn-warning btn-sm">{{ __('Kembali') }}</a>
                    <button type="submit" class="btn btn-primary btn-sm mx-3">{{ __('Simpan') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
