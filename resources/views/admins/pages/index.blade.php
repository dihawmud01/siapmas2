@section('title')
    {{ __('Halaman') }}
@endsection

@extends('admins.layout')
@section('content')
    <div class="card info-card sales-card">
        <div class="container">
            <h2 class="my-2 text-center">{{ __('Edit Halaman Utama') }}</h2>
            <div class="row">
                <table class="table">
                    <tr>
                        <td class="text-center">{{ __('No') }}</td>
                        <td class="text-center">{{ __('Judul') }}</td>
                        <td class="text-center">{{ __('Deskripsi') }}</td>
                        <td class="text-center">{{ __('Gambar') }}</td>
                        <td class="text-center">{{ __('Aksi') }}</td>
                    </tr>
                    @foreach ($pages as $page)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $page['title'] }}</td>
                            <td>{{ $page['description'] }}</td>
                            <td class="text-center">
                                <img
                                    src="{{ asset('storage/images/' . $page->img) }}"
                                    width="60"
                                    class="img-fluid img-thumbnail"
                                    style="max-height: 60px"
                                    alt="{{ __('Gambar Page') }}"
                                />
                            </td>
                            <td class="text-center">
                                <a
                                    href="{{ route('pages.edit', ['id' => $page->id]) }}"
                                    class="btn btn-warning btn-sm"
                                >
                                    {{ __('Edit') }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
