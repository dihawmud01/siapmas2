@section('title')
    {{ __('Belum Diverifikasi') }}
@endsection

@extends('admins.layout')

@section('content')
    <div class="card info-card sales-card">
        <div class="container my-3">
            <h2 class="card-title my-5">{{ __('Data Kader Belum Diverifikasi') }}</h2>
            <div class="card-body">
                <table class="table-striped table-hover table">
                    <tr>
                        <td class="text-center">{{ __('No.') }}</td>
                        <td class="text-center">{{ __('Nama') }}</td>
                        <td class="text-start">{{ __('Username:') }}</td>
                        <td class="text-center">{{ __('Nim') }}</td>
                        <td class="text-center">{{ __('PAC') }}</td>
                        <td class="text-center">{{ __('Profile') }}</td>
                        <td class="text-center">{{ __('Aksi') }}</td>
                        <td class="text-center"></td>
                    </tr>

                    @foreach ($unverifications as $user)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td class="text-center">{{ $user->nim }}</td>
                            <td class="text-center">{{ $user->pac->pac }}</td>
                            <td class="text-center">
                                <img
                                    src="{{ asset('storage/images/' . $user->img) }}"
                                    width="60"
                                    class="img-fluid img-thumbnail"
                                    style="max-height: 60px"
                                    alt="{{ $user->name }}"
                                />
                            </td>
                            <td class="text-center">
                                <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-danger btn-sm">
                                    {{ __('Verifikasi') }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            {{ $unverifications->links() }}
        </div>
    </div>
@endsection
