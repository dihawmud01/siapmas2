@section('title')
    {{ __('Admin') }}
@endsection

@extends('admins.layout')

@section('content')
    @if ($admins->isEmpty())
        <div class="d-flex align-items-center justify-content-center empty-content p-4">
            <div class="text-center">
                <h1 class="text-secondary mb-3">{{ __('Belum ada anggota yang terdaftar') }}</h1>
                <a href="{{ route('dashboard.admins.create') }}" class="btn btn-success btn-lg">
                    <i class="bi bi-person-plus-fill me-2"></i>
                    {{ __('Tambah Anggota') }}
                </a>
            </div>
        </div>
    @endif
    @if (! $admins->isEmpty())
        <div class="card info-card sales-card">
            <div class="container my-3">
                <div class="d-flex justify-content-between align-items-center my-3">
                    <h4 class="m-0">{{ __('Data Admin') }}</h4>
                    <div class="d-flex w-50 justify-content-end">
                        <form method="GET" action="{{ route('dashboard.admins.index') }}">
                            <input type="text" name="search" class="form-control search-input pe-4" placeholder="Cari Nama" value="{{ request('search') }}">
                        </form>
                        <a href="{{ route('dashboard.admins.create') }}" class="btn btn-success fw-semibold ms-2">
                                    <i class="bi bi-person-plus-fill"></i>
                        </a>
                        <span
                            style="
                                display: none;
                                position: absolute;
                                right: 10px;
                                top: 50%;
                                transform: translateY(-50%);
                                cursor: pointer;
                                color: gray;
                                font-size: 14px;
                                user-select: none;
                            "
                        >
                            &#x2715;
                        </span>
                    </div>
                </div>
                <table class="table-striped table-hover table">
                    <tr>
                        <td class="text-center">{{ __('No.') }}</td>
                        <td>{{ __('Nama') }}</td>
                        <td class="text-start">{{ __('PAC/Komisariat') }}</td>
                        <td class="text-center">{{ __('Profile') }}</td>
                        <td class="text-center">{{ __('Aksi') }}</td>
                    </tr>

                    @foreach ($admins as $admin)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ optional($admin->pac)->pac ?? '-' }}</td>
                            <td class="text-center">
                                <a href="{{ asset($admin['photo'] != 'default.png' 
                                    ? 'storage/images/user/photos/' . $admin['id'] . '/' . $admin['photo'] 
                                    : 'storage/images/default.png') }}">

                                    <img src="{{ asset($admin['photo'] != 'default.png' 
                                        ? 'storage/images/user/photos/' . $admin['id'] . '/' . $admin['photo'] 
                                        : 'storage/images/default.png') }}" 
                                        width="60"
                                        class="img-fluid img-thumbnail"
                                        style="max-height: 60px"
                                        alt="{{ __('Foto Anggota') }}">
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="{{  route('dashboard.admins.show', $admin->id) }}" class="btn btn-success btn-sm">
                                    {{ __('Detail') }}
                                </a>
                                <a
                                    href="{{ route('dashboard.admins.edit', $admin->id) }}"
                                    class="btn btn-warning btn-sm"
                                >
                                    {{ __('Edit') }}
                                </a>
                                <form action="{{ route('dashboard.admins.destroy', $admin->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    @endif
@endsection
