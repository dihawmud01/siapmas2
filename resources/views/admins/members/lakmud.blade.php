@section('title')
    {{ __('Kader Lakmud') }}
@endsection

@extends('admins.layout')
@section('page_title', __('Kaderisasi Lakmud'))
@section('path', __('Kaderisasi'))

@section('content')
    <div class="card info-card sales-card">
        <div class="container my-3">
            <div class="d-flex justify-content-between align-items-center my-3">
                <h4 class="m-0">{{ __('Data Kader Lakmud') }}</h4>
                <div class="position-relative d-inline-block w-25">
                <form method="GET" action="{{ route('dashboard.lakmud') }}">
                    <input type="text" name="search" class="form-control search-input pe-4" placeholder="Cari Nama atau PAC..." value="{{ request('search') }}">
                </form>

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
            <table class="table-striped table-hover table" id="table">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('No.') }}</th>
                        <th onclick="sortTable(1)" style="cursor: pointer">
                            {{ __('Nama') }}
                            <span style="color: gray">&#x25B2;&#x25BC;</span>
                        </th>
                        <th onclick="sortTable(2)" style="cursor: pointer">
                            {{ __('PAC') }}
                            <span style="color: gray">&#x25B2;&#x25BC;</span>
                        </th>
                        <th class="text-center">{{ __('Profile') }}</th>
                        <th class="text-center">{{ __('Aksi') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lakmudCadres as $lakmud)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $lakmud->name }}</td>
                            <td>{{ $lakmud->pac->pac }}</td>
                            <td class="text-center">
                                    <a href="{{ asset('storage/' . ($lakmud->photo != 'default.png' ? $lakmud->photo : 'images/default.png')) }}">
                                        <img 
                                            src="{{ asset('storage/' . ($lakmud->photo != 'default.png' ? $lakmud->photo : 'images/default.png')) }}"
                                            width="60"
                                            class="img-fluid img-thumbnail"
                                            style="max-height: 60px"
                                            alt="{{ __('Foto Anggota') }}"
                                        />
                                    </a>
                            </td>
                            <td class="text-center">
                                <a
                                    href="{{ route('dashboard.members.show', ['member' => $lakmud->id]) }}"
                                    class="btn btn-success btn-sm"
                                >
                                    {{ __('Detail') }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $lakmudCadres->links() }}
        </div>
    </div>

@endsection
