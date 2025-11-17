@section('title')
    {{ __('Pengurus') }}
@endsection

@extends('admins.layout')

@section('content')
    <div class="card info-card sales-card">
        <div class="container my-3">
            <h4 class="my-5">{{ __('Pengurus') }}</h4>

            <a class="btn btn-primary mx-3 mb-3" href="{{ route('administrators.create') }}">{{ __('Tambah') }}</a>

            <table class="table-striped table-hover table">
                <tr>
                    <td class="text-center">{{ __('No.') }}</td>
                    <td class="text-center">{{ __('Nama') }}</td>
                    <td class="text-start">{{ __('Jabatan') }}</td>
                    <td class="text-center">{{ __('Gambar') }}</td>
                    <td class="text-center">{{ __('Aksi') }}</td>
                </tr>
                @foreach ($administrators as $administrator)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $administrator->name }}</td>
                        <td>{{ $administrator->position }}</td>
                        <td class="text-center">
                            <img
                                src="{{ asset('storage/images/' . $administrator->img) }}"
                                alt=""
                                style="width: 40px; height: 40px; object-fit: cover"
                            />
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a
                                    href="{{ route('administrators.edit', ['id' => $administrator->id]) }}"
                                    class="btn btn-warning btn-sm"
                                >
                                    {{ __('Edit') }}
                                </a>
                                <form
                                    action="{{ route('administrators.destroy', ['id' => $administrator->id]) }}"
                                    method="POST"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm pl-2"
                                        onclick="return confirm('{{ __('Apakah Anda yakin ingin menghapus administrator ini?') }}')"
                                    >
                                        {{ __('Hapus') }}
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
