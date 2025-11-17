@section('name')
    {{ __('Quote') }}
@endsection

@extends('admins.layout')

@section('content')
    <div class="card info-card sales-card">
        <div class="container">
            <h4 class="mb-2 mt-5 text-center">{{ __('Edit Kategori') }}</h4>
            <div class="row">
                <div class="col-lg-8">
                    <form
                        action="{{ route('categories.book.update', $bookCategory->id) }}"
                        method="post"
                        enctype="multipart/form-data"
                    >
                        @method('PUT')
                        @csrf
                        <div class="my-3">
                            <label for="name">{{ __('Nama Kategori Buku') }}</label>
                            <input
                                type="text"
                                class="form-control my-4"
                                name="name"
                                id="name"
                                required
                                value="{{ $bookCategory->name }}"
                            />
                        </div>

                        <div class="my-3">
                            <a href="{{ route('book-categories.index') }}" class="btn btn-warning btn-sm">
                                {{ __('Kembali') }}
                            </a>
                            <button type="submit" class="btn btn-primary btn-sm mx-3">{{ __('Simpan') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
