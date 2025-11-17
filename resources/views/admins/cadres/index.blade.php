@section('title')
    {{ __('Kader') }}
@endsection

@extends('admins.layout')

@section('content')
    <div class="card info-card sales-card">
        <div class="container">
            <h2 class="my-2 text-center">{{ __('Data Kader') }}</h2>
            <h5>{{ __('Total Kader') }}: {{ $cadres->count() }}</h5>
            <div class="mb-3">
                <a href="{{ route('cadres.create') }}" class="btn btn-primary btn-sm">{{ __('Tambah Kader') }}</a>
            </div>
            <div class="col-12 col-sm-8 col-md-6 my-3">
                <form action="" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="search" placeholder="{{ __('Cari.....') }}" />
                        <button class="btn btn-primary">{{ __('Cari') }}</button>
                    </div>
                </form>
            </div>
            <div class="row">
    <div class="table-responsive" style="overflow-x:auto;">
        <table class="table table-bordered table-hover" style="min-width: 600px;">
            <thead class="table-light">
                <tr>
                    <th class="text-center">{{ __('No') }}</th>
                    <th class="text-center">{{ __('Nama') }}</th>
                    <th>{{ __('PAC') }}</th>
                    <th class="text-center">{{ __('Kelamin') }}</th>
                    <th class="text-center">{{ __('Profile') }}</th>
                    <th class="text-center" colspan="3">{{ __('Aksi') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cadres as $cadre)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $cadre['name'] }}</td>
                        <td>{{ $cadre['pac'] }}</td>
                        <td class="text-center">{{ $cadre['gender'] }}</td>
                        <td class="text-center">
                            <img
                                src="{{ asset('storage/uploads/' . $cadre['photo']) }}"
                                width="60"
                                class="img-fluid img-thumbnail"
                                style="max-height: 60px;"
                                alt="{{ __('Profile') }}"
                            />
                        </td>
                        <td class="text-end">
                            <a
                                href="{{ route('cadres.view', ['id' => $cadre->id]) }}"
                                class="btn btn-secondary btn-sm"
                            >
                                {{ __('Lihat') }}
                            </a>
                        </td>
                        <td class="text-center">
                            <a
                                href="{{ route('cadres.edit', ['id' => $cadre->id]) }}"
                                class="btn btn-warning btn-sm"
                            >
                                {{ __('Edit') }}
                            </a>
                        </td>
                        <td class="text-start">
                            <form action="{{ route('cadres.destroy', $cadre->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('{{ __('Apakah Anda yakin ingin menghapus cadres ini?') }}')"
                                >
                                    {{ __('Hapus') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
        </div>
    </div>
@endsection
