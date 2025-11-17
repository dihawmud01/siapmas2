@extends('admins.layout')

@section('title', __('Detail Admin'))

@section('content')
<div class="container mt-4">
    <div class="card shadow p-4">
        <h4 class="mb-4">Detail Admin</h4>
        <div class="row">
            <div class="col-md-4 text-center">
                <a href="{{ asset($user->photo != 'default.png' 
                    ? 'storage/images/user/photos/' . $user->id . '/' . $user->photo 
                    : 'storage/images/default.png') }}">

                    <img src="{{ asset($user->photo != 'default.png' 
                        ? 'storage/images/user/photos/' . $user->id . '/' . $user->photo 
                        : 'storage/images/default.png') }}" 
                        class="rounded-circle img-thumbnail" width="150" style="max-height: 150px;"
                        alt="{{ __('Foto Admin') }}">
                </a>
            </div>
            <div class="col-md-8">
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <td>{{ $user->id }}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>{{ $user->username }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Bio</th>
                        <td>{{ $user->bio ?: '-' }}</td>
                    </tr>
                    <tr>
                        <th>Role</th>
                        <td>
                            @if($user->role_id == 1)
                                Super Admin
                            @elseif($user->role_id == 2)
                                Admin PC
                            @elseif($user->role_id == 3)
                                Admin PAC
                            @else
                                Tidak Diketahui
                            @endif
                        </td>
                    </tr>
                </table>
                <a href="{{ route('dashboard.admins.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
