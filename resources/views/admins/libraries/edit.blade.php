@section('title')
    {{ __('Buku') }}
@endsection

@extends('admins.layout')

@section('content')
    <div class="card info-card sales-card">
        <div class="container">
            <h4 class="mb-2 mt-5 text-center">{{ __('Edit Buku') }}</h4>
            <div class="row">
                <div class="col-lg-6">
                    <form
                        action="{{ route('libraries.update', ['id' => $library->id] }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >
                        @method('PUT')
                        @csrf
                        <label for="file">
                            {{ __('File (PDF/DOCX)') }}
                        </label>
                        <input
                            type="file"
                            class="form-control my-4"
                            name="file"
                            id="file"
                            accept="application/pdf,application/vnd.ms-word"
                        />

                        <label for="img">{{ __('Cover') }}</label>
                        <input type="file" class="form-control my-4" name="img" id="img" />
                        <div class="my-3"></div>

                        <label for="title">{{ __('Judul') }}</label>
                        <input
                            type="text"
                            class="form-control"
                            name="title"
                            id="title"
                            placeholder="{{ __('Max 15 Huruf') }}"
                        />

                        <label for="author">{{ __('Penulis') }}</label>
                        <input type="text" class="form-control" name="author" id="author" />
                        <div class="my-3"></div>

                        <label for="publisher">{{ __('Penerbit') }}</label>
                        <input type="text" class="form-control" name="publisher" id="publisher" />
                        <div class="my-3"></div>

                        <label for="year">{{ __('Tahun Terbit') }}</label>
                        <input type="text" class="form-control" name="year" id="year" />
                        <div class="my-3"></div>

                        <label for="isbn">{{ __('Nomor ISBN') }}</label>
                        <input type="text" class="form-control" name="isbn" id="isbn" />
                        <div class="my-3"></div>

                        <label for="lang">{{ __('Bahasa yang Digunakan') }}</label>
                        <input type="text" class="form-control" name="lang" id="lang" />
                        <div class="my-3"></div>

                        <label for="category">{{ __('Kategori') }}</label>
                        <select name="category" class="form-select" required aria-label="category">
                            <option disabled selected>{{ __(' --Pilih--') }}</option>
                            @foreach ($category as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->title }}
                                </option>
                            @endforeach
                        </select>
                        <div class="my-3"></div>

                        <label for="total_pages">{{ __('Jumlah Halaman') }}</label>
                        <input type="number" class="form-control" name="total_pages" id="totalPages" />
                        <div class="my-3"></div>

                        <label for="description">{{ __('Deskripsi') }}</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                        <div class="my-3"></div>

                        <div class="my-3">
                            <a href="{{ route('admin.libraries.index') }}" class="btn btn-warning btn-sm">
                                {{ __('Kembali') }}
                            </a>
                            <button type="submit" class="btn btn-primary btn-sm mx-3">{{ __('Simpan') }}</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6">
                    <div class="text-center">
                        <img
                            class="pt-6"
                            src="{{ asset('storage/images/' . $library->img) }}"
                            alt="{{ __('Cover') }}"
                            style="width: 90%; object-fit: contain"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
