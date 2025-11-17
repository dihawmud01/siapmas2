@section('title')
@endsection

@extends('admins.layout')

@section('content')
    <div class="card info-card sales-card">
        <div class="container">
            <h2 class="my-2 text-center">
                {{ __('Data Anggota') }}<br />
                {{ __('PAC') }}
                @foreach ($pac->users->take(1) as $item)
                    {{ $item->pac->pac }}
                @endforeach
            </h2>

            <h5>{{ __('Total Anggota PAC') }} {{ $pac->pac }}: {{ $pac->members->count() }}</h5>

            <div class="mb-3">
                <a href="{{ route('pac.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left"></i> {{ __('Kembali') }}
                </a>
            </div>
            <div class="col-12 col-sm-8 col-md-6 my-3">
                <form action="{{ route('dashboard.members.pac.search', ['slug' => $pac->slug]) }}" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="search" placeholder="{{ __('Search...') }}" value="{{ request('search') }}" />
                        <button class="btn btn-primary">{{ __('Search') }}</button>
                    </div>
                </form>
            </div>
            @if(isset($pac))
            <div class="text-end m-3">
                <form action="{{ route('users.pac-pdf', $pac->slug) }}" method="GET">
                    <select name="category" class="form-select d-inline-block w-auto">
                        <option value="IPNU" {{ request('category', 'all') === 'IPNU' ? 'selected' : '' }}>
                            {{ __('IPNU') }}
                        </option>
                        <option value="IPPNU" {{ request('category', 'all') === 'IPPNU' ? 'selected' : '' }}>
                            {{ __('IPPNU') }}
                        </option>
                    </select>
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-printer"></i> {{ __('Unduh Data') }}
                    </button>
                </form>
            </div>
            @endif





            <div class="row">
                <table class="table text-center" id="table">
                    <thead>
                        <tr>
                            <th>{{ __('No.') }}</th>
                            <th>{{ __('Nama') }}</th>
                            <th>{{ __('Kaderisasi') }}</th>
                            <th>{{ __('Aksi') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if ($message)
                        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
@forelse ($members as $item)
    <tr data-row>
        <td class="text-center">{{ ($members->currentPage() - 1) * $members->perPage() + $loop->iteration }}</td>
        <td class="text-center">{{ $item->name }}</td>
        <td class="text-center">{{ $item->cadre_level }}</td>
        <td class="text-center">
            <a href="{{ route('dashboard.members.show', $item) }}" class="btn btn-success btn-sm">
                {{ __('Detail') }}
            </a>
            <a href="{{ route('dashboard.members.edit', $item) }}" class="btn btn-warning btn-sm">
                {{ __('Edit') }}
            </a>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="4" class="text-center text-muted">
            <b>{{ __('PAC ini belum memiliki anggota.') }}</b>
        </td>
    </tr>
@endforelse


                    </tbody>
                </table>
                {{ $members->links() }}
            </div>
        </div>
    </div>
@endsection