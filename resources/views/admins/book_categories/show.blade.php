@section('title')
    {{ __('Kategori Buku') }}
@endsection

@extends('admins.layout')

@section('content')
    <div class="card info-card sales-card">
        <div class="container my-3">
            <h4 class="my-5">
                {{ __('Kategori Buku') }}
                <span style="color: blue">{{ $bookCategory->title }}</span>
            </h4>

            <div class="row">
                <table class="table">
                    <tr>
                        <td class="text-center">{{ __('No.') }}</td>
                        <td class="text-start">{{ __('Judul') }}</td>
                        <td class="text-center">{{ __('Cover') }}</td>
                        <td>{{ __('Aksi') }}</td>
                    </tr>
                    @foreach ($bookCategory->library as $library)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ Str::limit($library->title, 30) }}</td>
                            <td class="text-center">
                                <img
                                    src="{{ asset('storage/images/' . $library->img) }}"
                                    width="60"
                                    class="img-fluid img-thumbnail"
                                    style="max-height: 60px"
                                    alt="{{ $library->title }}"
                                />
                            </td>
                            <td class="text-start">
                                <form
                                    action="{{ route('admin.libraries.destroy', ['id' => $library->id]) }}"
                                    method="POST"
                                >
                                    @csrf
                                    @method('DELETE')
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
                </table>
                <div>
                    <a href="{{ route('book-categories.index') }} " class="btn btn-warning btn-sm">
                        {{ __('Kembali') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
