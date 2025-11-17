@section('title')
    {{ __('Cadre') }}
@endsection

@extends('admins.layout')

@section('content')
    <div class="card info-card sales-card">
        <div class="container">
            <h4 class="mb-2 mt-5 text-center">{{ __('Detail Anggota Kader') }}</h4>
            <div class="row">
                <div class="col-sm-6">
                    <form
                        action="{{ route('cadre.update', ['id' => $cadre->id]) }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Nama') }}</label>
                            <input
                                type="text"
                                name="name"
                                class="form-control mb-3"
                                readonly
                                value="{{ $cadre->name }}"
                                required
                                id="name"
                            />
                        </div>

                        <div>
                            <div class="mb-3">
                                <label for="address" class="form-label">{{ __('Alamat Lengkap') }}</label>
                                <input
                                    type="textarea"
                                    name="address"
                                    class="form-control mb-3"
                                    readonly
                                    value="{{ $cadre->address }}"
                                    id="address"
                                />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="nim" class="form-label">{{ __('Nomor Induk Mahasiswa (NIM)') }}</label>
                            <input
                                type="text"
                                class="form-control mb-3"
                                name="nim"
                                readonly
                                value="{{ $cadre->nim }}"
                                id="nim"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="gender">{{ __('Gender') }}</label>
                            <input
                                type="text"
                                class="form-control mb-3"
                                name="gender"
                                readonly
                                value="{{ $cadre->gender }}"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="place_of_birth">{{ __('Tempat Lahir') }}</label>
                            <input
                                type="text"
                                class="form-control mb-3"
                                name="place_of_birth"
                                readonly
                                value="{{ $cadre->place_of_birth }}"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="date_of_birth">{{ __('Tanggal Lahir') }}</label>
                            <input
                                type="text"
                                class="form-control mb-3"
                                name="date_of_birth"
                                readonly
                                value="{{ $cadre->date_of_birth }}"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="wa">{{ __('Nomor WhatsApp') }}</label>
                            <input type="text" class="form-control mb-3" name="wa" readonly value="{{ $cadre->wa }}" />
                        </div>
                        <div class="mb-3">
                            <label for="school">{{ __('SMA/SMK/MAN/Sederajat') }}</label>
                            <input
                                type="text"
                                class="form-control mb-3"
                                name="school"
                                readonly
                                value="{{ $cadre->school }}"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="boardingSchool">{{ __('Alumni Pondok Pesantren') }}</label>
                            <input
                                type="text"
                                class="form-control mb-3"
                                name="boarding_school"
                                readonly
                                value="{{ $cadre->boarding_school }}"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="gradYear">{{ __('Tahun Lulus SMA/SMK/MAN/Sederajat') }}</label>
                            <input
                                type="text"
                                class="form-control mb-3"
                                name="grad_year"
                                readonly
                                value="{{ $cadre->grad_year }}"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="collegeYear">{{ __('Tahun Masuk Kuliah') }}</label>
                            <input
                                type="text"
                                class="form-control mb-3"
                                name="college_year"
                                readonly
                                value="{{ $cadre->college_year }}"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="makestaYear">{{ __('Tahun Makesta') }}</label>
                            <input
                                type="text"
                                class="form-control mb-3"
                                name="makesta-year"
                                readonly
                                value="{{ $cadre->makesta_year }}"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="lakmud_year">{{ __('Tahun Lakmud') }}</label>
                            <input
                                type="text"
                                class="form-control mb-3"
                                name="lakmud_year"
                                readonly
                                value="{{ $cadre->lakmud_year }}"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="lakut_year">{{ __('Tahun Lakut') }}</label>
                            <input
                                type="text"
                                class="form-control mb-3"
                                name="lakut_year"
                                readonly
                                value="{{ $cadre->lakut_year }}"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="latinpel_year">{{ __('Tahun Latinpel') }}</label>
                            <input
                                type="text"
                                class="form-control mb-3"
                                name="latinpel_year"
                                readonly
                                value="{{ $cadre->latinpel_year }}"
                            />
                        </div>

                        <div class="mt-3">
                            <a href="{{ route('cadres.index') }}" class="btn btn-warning btn-sm">
                                {{ __('Kembali') }}
                            </a>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6">
                    <div class="text-center">
                        <img
                            src="{{ asset('storage/uploads/' . $cadre['photo']) }}"
                            width="100%"
                            class="img-thumbnail mt-5"
                            style="border-radius: 25px"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
