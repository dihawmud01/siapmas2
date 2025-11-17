@section('title')
    {{ __('Perpustakaan') }}
@endsection

@extends('admins.layout')

@section('content')
    <div class="card info-card sales-card">
        <div class="container">
            <h4 class="my-4 text-center">{{ __('Data Buku Perpustakaan') }}</h4>

            <div class="mb-3">
                <a href="{{ route('admin.libraries.create') }}" class="btn btn-primary btn-sm">
                    {{ __('Tambah Buku') }}
                </a>
            </div>

            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">{{ __('No.') }}</th>
                            <th class="text-start">{{ __('Judul') }}</th>
                            <th class="text-start">{{ __('Kategori') }}</th>
                            <th class="text-center">{{ __('Cover') }}</th>
                            <th>{{ __('Aksi') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($libraries as $library)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ Str::limit($library->judul, 30) }}</td>
                                <td>{{ $library->book_categories->title }}</td>
                                <td class="text-center">
                                    <img
                                        src="{{ asset('storage/images/' . $library->image) }}"
                                        width="60"
                                        class="img-fluid img-thumbnail"
                                        style="max-height: 60px"
                                        alt="{{ __('Cover') }}"
                                    />
                                </td>
                                <td class="text-start">
                                    <form
                                        action="{{ route('libraries.destroy', ['id' => $library->id]) }}"
                                        method="POST"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <a
                                            href="{{ route('libraries.edit', ['id' => $library->id]) }}"
                                            class="btn btn-warning btn-sm"
                                        >
                                            {{ __('Edit') }}
                                        </a>
                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('{{ __('Apakah Anda yakin ingin menghapus buku ini?') }}')"
                                        >
                                            {{ __('Hapus') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $libraries->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
