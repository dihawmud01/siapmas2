@extends('admins.layout')

@section('title')
    {{ __('Kader') }}
@endsection

@section('content')
    <div class="card info-card sales-card">
        <div class="container">
            <h4 class="my-3 text-center">{{ __('Tambah Anggota') }}</h4>
            <form action="{{ route('admin.cadre.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Nama') }}</label>
                    <input type="text" name="name" class="form-control mb-3" id="name" required />
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">{{ __('Alamat Lengkap') }}</label>
                    <textarea name="address" class="form-control mb-3" id="address" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="nim" class="form-label">{{ __('Nomor Induk Mahasiswa (NIM)') }}</label>
                    <input type="text" class="form-control mb-3" name="nim" id="nim" required />
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label">{{ __('Jenis Kelamin') }}</label>
                    <select name="gender" class="form-select" id="gender" required>
                        <option disabled selected>{{ __('-- Pilih --') }}</option>
                        @foreach ($genders as $value => $label)
                            <option value="{{ $value }}" {{ old('gender') == $value ? 'selected' : '' }}>
                                {{ __($label) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="place_of_birth" class="form-label">{{ __('Tempat Lahir') }}</label>
                    <input type="text" class="form-control" name="place_of_birth" id="placeOfBirth" required />
                </div>

                <div class="mb-3">
                    <label for="date_of_birth" class="form-label">{{ __('Tanggal Lahir') }}</label>
                    <input type="date" class="form-control" name="date_of_birth" id="dateOfBirth" required />
                </div>

                <div class="mb-3">
                    <label for="wa" class="form-label">{{ __('Nomor WhatsApp') }}</label>
                    <input type="text" class="form-control" name="wa" id="wa" required />
                </div>

                <div class="mb-3">
                    <label for="hobby" class="form-label">{{ __('Hobi') }}</label>
                    <select name="hobby" class="form-select" id="hobby" required>
                        <option disabled selected>{{ __('-- Pilih --') }}</option>
                        @foreach ($hobbies as $value => $label)
                            <option value="{{ $value }}" {{ old('hobby') == $value ? 'selected' : '' }}>
                                {{ __($label) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="highschool" class="form-label">{{ __('SMA/SMK/MA/Sederajat') }}</label>
                    <input type="text" class="form-control" name="highschool" id="highschool" required />
                </div>

                <div class="mb-3">
                    <label for="grad_year" class="form-label">{{ __('Tahun Lulus') }}</label>
                    <input type="text" class="form-control" name="grad_year" id="gradYear" required />
                </div>

                <div class="mb-3">
                    <label for="boarding_school" class="form-label">{{ __('Pesantren') }}</label>
                    <input
                        type="text"
                        class="form-control"
                        name="boarding_school"
                        id="boardingSchool"
                        placeholder="{{ __('Isi dengan "-" jika belum pernah') }}"
                        required
                    />
                </div>

                <div class="mb-3">
                    <label for="college_year" class="form-label">{{ __('Tahun Masuk Kuliah') }}</label>
                    <input type="text" class="form-control" name="college_year" id="collegeYear" required />
                </div>

                <div class="mb-3">
                    <label for="pac" class="form-label">{{ __('PAC') }}</label>
                    <select name="pac" class="form-select" id="pac" required>
                        <option disabled selected>{{ __('-- Pilih --') }}</option>
                        @foreach ($pacList as $pac)
                            <option value="{{ $pac }}" {{ old('pac') == $pac ? 'selected' : '' }}>
                                {{ $pac }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="makesta_year" class="form-label">{{ __('Tahun Makesta') }}</label>
                    <select name="makesta_year" class="form-select" required>
                        <option disabled selected>{{ __('-- Pilih --') }}</option>
                        <option value="Belum Makesta" {{ old('makesta_year' == 'Belum Makesta' ? 'selected' : '') }}>
                            {{ __('Belum Makesta') }}
                        </option>
                        @foreach ($years as $value => $label)
                            <option value="{{ $value }}" {{ old('makesta_year') == $value ? 'selected' : '' }}>
                                {{ __($label) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="organizer_makesta" class="form-label">{{ __('PAC Penyelenggara Makesta') }}</label>
                    <select name="organizer_makesta" class="form-select" required>
                        <option disabled selected>{{ __('-- Pilih --') }}</option>
                        @foreach ($pacList as $pac)
                            <option value="{{ $pac }}" {{ old('organizer_makesta') == $pac ? 'selected' : '' }}>
                                {{ $pac }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="lakmud_year" class="form-label">{{ __('Tahun Lakmud') }}</label>
                    <select name="lakmud_year" class="form-select" required>
                        <option disabled selected>{{ __('--Pilih--') }}</option>
                        <option value="Belum Lakmud" {{ old('lakmud_year' == 'Belum Lakmud' ? 'selected' : '') }}>
                            {{ __('Belum Lakmud') }}
                        </option>
                        @foreach ($years as $value => $label)
                            <option value="{{ $value }}" {{ old('lakmud_year') == $value ? 'selected' : '' }}>
                                {{ __($label) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="lakut_year" class="form-label">{{ __('Tahun Lakut') }}</label>
                    <select name="lakut_year" class="form-select" required>
                        @foreach ($years as $value => $label)
                            @if ($value === 'Belum')
                                <option value="Belum Lakut">{{ __('Belum Lakut') }}</option>
                            @else
                                <option value="{{ $value }}" {{ old('lakut_year') == $value ? 'selected' : '' }}>
                                    {{ __($label) }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="latinpel_year" class="form-label">{{ __('Tahun Latinpel') }}</label>
                    <select name="latinpel_year" class="form-select" required>
                        @foreach ($years as $value => $label)
                            @if ($value === 'Belum')
                                <option value="Belum Latinpel">{{ __('Belum Latinpel') }}</option>
                            @else
                                <option value="{{ $value }}" {{ old('latinpel_year') == $value ? 'selected' : '' }}>
                                    {{ __($label) }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="informal" class="form-label">{{ __('Mengikuti Sekolah Informal') }}</label>
                    <select name="informal" class="form-select" required>
                        @foreach ($attendanceCount as $value => $label)
                            <option value="{{ $value }}" {{ old('informal') == $value ? 'selected' : '' }}>
                                {{ __($label) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="organizer_informal" class="form-label">
                        {{ __('PAC Penyelenggara Sekolah Informal') }}
                    </label>
                    <select name="organizer_informal" class="form-select" required>
                        <option disabled selected>{{ __('-- Pilih --') }}</option>
                        @foreach ($pacList as $pac)
                            <option value="{{ $pac }}" {{ old('organizer_informal') == $pac ? 'selected' : '' }}>
                                {{ __($pac) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="nonformal" class="form-label">
                        {{ __('Berapa Kali Mengikuti Sekolah Non Formal') }}
                    </label>
                    <select name="nonformal" class="form-select" required>
                        @foreach ($attendanceCount as $value => $label)
                            <option value="{{ $value }}" {{ old('nonformal') == $value ? 'selected' : '' }}>
                                {{ __($label) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="organizer_nonformal" class="form-label">
                        {{ __('PAC Penyelenggara Sekolah Nonformal') }}
                    </label>
                    <select name="organizer_nonformal" class="form-select" required>
                        <option disabled selected>{{ __('--Pilih--') }}</option>
                        @foreach ($pacList as $pac)
                            <option value="{{ $pac }}" {{ old('pac') == $pac ? 'selected' : '' }}>
                                {{ $pac }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label">{{ __('Pilih Foto') }}</label>
                    <input name="photo" class="form-control" type="file" id="photo" />
                </div>

                <div class="mb-3">
                    <a href="{{ route('admin.cadre.index') }}" class="btn btn-warning btn-sm">{{ __('Kembali') }}</a>
                    <button type="submit" class="btn btn-primary btn-sm">{{ __('Simpan') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
