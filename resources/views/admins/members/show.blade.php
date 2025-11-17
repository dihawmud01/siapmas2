@section('title')
    {{ __('Detail Anggota') }}
@endsection

@extends('admins.layout')

@section('content')
    <x-breadcrumb :values="[__('Anggota'), __('Detail Anggota')]" />

    <div class="card info-card sales-card min-vh-100">
        <div class="card-header bg-transparent text-center">
            <div class="d-flex align-items-center p-4">
                <div class="text-start">
                    <a href="{{ route('dashboard.members.index') }}" class="btn fs-4">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                </div>
                <div class="d-flex flex-column w-100">
                    <h3 class="fw-bold">{{ __('Detail Profil Anggota') }}</h3>
                </div>
            </div>
        </div>
        <div class="container-fluid p-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="mb-4">
                        <div class="text-center">
                            <img
                                src="{{ asset('storage/images/' . ($member->photo != 'default.png' ? 'members/' . strtolower(str_replace(' ', '-', $member->pac->pac)) . '/photo/' . $member['photo'] : 'default.png')) }}"
                                alt="{{ $member->name }}"
                                class="rounded-circle img-fluid"
                                style="width: 150px; height: 150px; object-fit: cover"
                            />
                            <h5 class="my-3">{{ $member->name }}</h5>
                            <h6 class="my-3">{{ __('PAC') }} {{ $member->pac->pac }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="mb-4">
                        <div>
                            @foreach ($detailMember as $label => $value)
                                <div class="row pt-3">
                                    <div class="col-sm-3">
                                        <p class="mb-0">{{ __($label) }}</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{ $value }}</p>
                                    </div>
                                </div>
                                <hr />
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
