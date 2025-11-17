@section('title')
    {{ __('Kategori Buku') }}
@endsection

@extends('admins.layout')

@section('content')
    <div class="card info-card sales-card">
        <div class="container my-3">
            <h4 class="my-5">{{ __('Kategori Buku') }}</h4>

            <a class="btn btn-primary mx-3 mb-3" href="{{ route('book-categories.create') }}">{{ __('Tambah') }}</a>

            <table class="table-striped table-hover table">
                <tr>
                    <th class="text-center">{{ __('No.') }}</th>
                    <th>{{ __('Category') }}</th>
                    <th class="text-start">{{ __('Jumlah') }}</th>
                    <th class="text-center">{{ __('Aksi') }}</th>
                </tr>
                @foreach ($categories as $category)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->lib->count() }}</td>
                        <td class="text-center">
                            <form
                                action="{{ route('book-categories.destroy', ['id' => $category->id]) }}"
                                method="POST"
                            >
                                <a
                                    href="{{ route('book-categories.show', ['id' => $category->id]) }}"
                                    class="btn btn-success btn-sm"
                                >
                                    {{ __('Lihat') }}
                                </a>
                                <a
                                    href="{{ route('book-categories.edit', ['id' => $category->id]) }}"
                                    class="btn btn-warning btn-sm"
                                >
                                    {{ __('Edit') }}
                                </a>
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm pl-2"
                                    onclick="return confirm('{{ __('Apakah Anda yakin ingin menghapus Kategori ini?') }}')"
                                >
                                    {{ __('Hapus') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            <div>
                <a href="{{ route('dashboard') }}" class="btn btn-warning btn-sm">{{ __('Kembali') }}</a>
            </div>
        </div>
    </div>
@endsection
