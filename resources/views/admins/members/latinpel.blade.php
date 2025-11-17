@section('title')
    {{ __('Kader Latinpel') }}
@endsection

@extends('admins.layout')
@section('page_title', __('Kaderisasi Latinpel'))

@section('content')
    <div class="card info-card sales-card">
        <div class="container my-3">
            <div class="d-flex justify-content-between align-items-center my-3">
                <h4 class="m-0">{{ __('Data Kader Latinpel') }}</h4>
                <div class="position-relative d-inline-block w-25">
                <form method="GET" action="{{ route('dashboard.latinpel') }}">
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
                    @foreach ($latinpelCadres as $cadre)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $cadre->name }}</td>
                            <td>{{ $cadre->pac->pac }}</td>
                            <td class="text-center">
                                    <a href="{{ asset('storage/' . ($cadre->photo != 'default.png' ? $cadre->photo : 'images/default.png')) }}">
                                        <img 
                                            src="{{ asset('storage/' . ($cadre->photo != 'default.png' ? $cadre->photo : 'images/default.png')) }}"
                                            width="60"
                                            class="img-fluid img-thumbnail"
                                            style="max-height: 60px"
                                            alt="{{ __('Foto Anggota') }}"
                                        />
                                    </a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('dashboard.members.show', ['member' => $cadre->id]) }}" class="btn btn-success btn-sm">
                                    {{ __('Detail') }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $latinpelCadres->links() }}
        </div>
    </div>
@endsection
