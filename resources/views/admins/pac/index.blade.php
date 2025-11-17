@section('title')
    {{ 'PAC' }}
@endsection

@extends('admins.layout')
@section('page_title', __('PAC'))

@section('content')
    <div class="card info-card sales-card">
        <div class="container">
            <h2 class="my-2 text-center">{{ __('Data PAC') }}</h2>
            <h5>{{ __('Total PAC:') }} {{ $pacs->count() }}</h5>

            <div class="col-12 col-sm-8 col-md-6 my-3">
                <form action="" method="get" class="d-flex">
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="{{ __('Cari PAC') }}"
                        value="{{ request('search') }}"
                    />
                    <button type="submit" class="btn btn-primary mx-2">{{ __('Cari') }}</button>
                </form>
            </div>

            <div class="row">
                <table class="table-striped table-hover table">
                    <thead>
                        <tr>
                            <th class="text-center">{{ __('No.') }}</th>
                            <th class="text-start">{{ __('Nama PAC') }}</th>
                            <th class="text-start">{{ __('Jumlah Kader') }}</th>
                            <th class="text-center">{{ __('Aksi') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pacs as $pac)
                            <tr>
                                <td class="text-center"></td>
                                <td>{{ $pac['pac'] }}</td>
                                <td>
                                    <a
                                        href="{{ route('members.pac.list', ['slug' => $pac->slug]) }}"
                                        class="btn btn-success btn-sm"
                                        aria-label="{{ __('Lihat jumlah kader') }}"
                                    >
                                        {{ $pac->members->count() }} {{ __('Kader') }}
                                    </a>
                                </td>
                                <td class="text-center">
                                    <form action="" method="post">
                                        @csrf
                                        <a
                                            href="{{ route('members.pac.list', ['slug' => $pac->slug]) }}"
                                            class="btn btn-secondary btn-sm"
                                            aria-label="{{ __('Lihat detail PAC') }}"
                                        >
                                            {{ __('Lihat') }}
                                        </a>

                                        @if (in_array(auth()->user()->role_id, [1]))
                                            <a
                                                href="{{ route('pac.edit', ['id' => $pac->id]) }}"
                                                class="btn btn-warning btn-sm"
                                                aria-label="{{ __('Edit PAC') }}"
                                            >
                                                {{ __('Edit') }}
                                            </a>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
