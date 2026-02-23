@section('title')
    {{ __('Profil') }}
@endsection

@extends('users.layout')

@section('content')
    <div class="container my-4" style="padding-top: 4rem">
        <main id="main" class="main">
            <div class="pagetitle mt-4">
                <h1>{{ __('Profil') }}</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('index') }}" class="text-secondary text-decoration-underline">
                                {{ __('Home') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item text-secondary">{{ $user->role->role }}</li>
                        <li class="breadcrumb-item active text-success fw-semibold">{{ __('Profile') }}</li>
                    </ol>
                </nav>
            </div>

            <section class="section profile">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body profile-card d-flex flex-column align-items-center pt-4">
                                <img
                                    src="{{ asset('storage/images/user/photos/' . $user['id'] . '/' . $user['photo']) }}"
                                    alt="{{ __('Profil') }}"
                                    class="rounded-circle mb-3"
                                    style="height: 200px; width: 200px; object-fit: cover"
                                />
                                <h3>{{ $user->username }}</h3>
                                <div class="social-links mt-1">
                                    <a href="#" class="text-success twitter me-1"><i class="bi bi-twitter"></i></a>
                                    <a href="#" class="text-success facebook me-1"><i class="bi bi-facebook"></i></a>
                                    <a href="#" class="text-success instagram me-1"><i class="bi bi-instagram"></i></a>
                                    <a href="#" class="text-success linkedin"><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body pt-3">
                                <ul class="nav nav-tabs nav-tabs-bordered">
                                    <li class="nav-item">
                                        <button
                                            class="nav-link active tab"
                                            data-bs-toggle="tab"
                                            data-bs-target="#profileEdit"
                                        >
                                            {{ __('Edit Profil') }}
                                        </button>
                                    </li>

                                    <li class="nav-item">
                                        <button
                                            class="nav-link tab"
                                            data-bs-toggle="tab"
                                            data-bs-target="#changePassword"
                                        >
                                            {{ __('Ubah Kata Sandi') }}
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content pt-2">
                                    <div class="tab-pane fade show active profile-edit pt-3" id="profileEdit">
                                        <form
                                            method="POST"
                                            action="{{ route('profile.update') }}"
                                            enctype="multipart/form-data"
                                        >
                                            @csrf
                                            @method('PUT')

                                            @if ($errors->any())
                                                <div class="alert alert-danger mb-3">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>
                                                                {{ $error }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                            <div class="row mb-3">
                                                <label for="profile-img" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Foto Profil') }}
                                                </label>
                                                
                                                <div class="col-md-8 col-lg-9">
                                                    <a href="{{ asset($user->photo != 'default.png' 
                                                        ? 'storage/images/user/photos/' . $user->id . '/' . $user->photo 
                                                        : 'storage/images/default.png') }}" id="photo-link">
    
                                                    <img src="{{ asset($user->photo != 'default.png' 
                                                        ? 'storage/images/user/photos/' . $user->id . '/' . $user->photo 
                                                        : 'storage/images/default.png') }}" 
                                                        
                                                        class="rounded-circle"
                                                        style="height: 200px; width: 200px; object-fit: cover"
                                                        id="previewImg"
                                                        alt="{{ __('Foto Profile') }}">
                                                    </a>
                                                    <div class="pt-2">
                                                        <div class="mb-3">
                                                            <div>
                                                                <input
                                                                    class="form-control edit-profile"
                                                                    id="formFileSm"
                                                                    type="file"
                                                                    name="images"
                                                                    onchange="previewFile()"
                                                                />
                                                                <input
                                                                    type="hidden"
                                                                    name="remove_img"
                                                                    id="removeImg"
                                                                    value="0"
                                                                />
                                                            </div>
                                                        </div>
                                                        <p class="text-danger mb-1">
                                                            {{ __('Maksimal 4 MB') }} |
                                                            {{ __('Format JPG/PNG/JPEG') }}
                                                        </p>
                                                        <div class="mb-3">
                                                            <button
                                                                type="button"
                                                                class="btn btn-secondary mt-2"
                                                                onclick="cancelImg()"
                                                            >
                                                                {{ __('Batal') }}
                                                            </button>
                                                            <button
                                                                type="button"
                                                                class="btn btn-danger me-1 mt-2"
                                                                onclick="removeImage()"
                                                            >
                                                                {{ __('Hapus') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="name" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Nama Lengkap') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                        name="name"
                                                        type="text"
                                                        class="form-control edit-profile"
                                                        id="name"
                                                        value="{{ $user->name }}"
                                                        required
                                                    />
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="bio" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Biografi') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                        name="bio"
                                                        type="text"
                                                        class="form-control edit-profile"
                                                        id="bio"
                                                        value="{{ $user->bio }}"
                                                        required
                                                    />
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                        <label for="fullName" id="name" class="col-md-4 col-lg-3 col-form-label">
                                            {{ __('Username') }}
                                        </label>
                                        <div class="col-md-8 col-lg-9">
                                            <input
                                                name="fullName"
                                                type="text"
                                                class="form-control edit-profile bg-light text-secondary"
                                                id="fullName"
                                                value="{{ $user->username }}"
                                                readonly
                                            />
                                        </div>
                                            </div>

                                            <!--<div class="row mb-3">-->
                                            <!--    <label for="nim" class="col-md-4 col-lg-3 col-form-label">-->
                                            <!--        {{ __('Nomor Induk Mahasiswa (NIM)') }}-->
                                            <!--    </label>-->
                                            <!--    <div class="col-md-8 col-lg-9">-->
                                            <!--        <input-->
                                            <!--            name="nim"-->
                                            <!--            type="text"-->
                                            <!--            class="form-control edit-profile"-->
                                            <!--            id="nim"-->
                                            <!--            value="{{ $user->nim }}"-->
                                            <!--            readonly-->
                                            <!--        />-->
                                            <!--    </div>-->
                                            <!--</div>-->

                                            <div class="row mb-3">
                                        <label for="pac" class="col-md-4 col-lg-3 col-form-label">
                                            {{ __('PAC') }}
                                        </label>
                                        <div class="col-md-8 col-lg-9">
                                            <input
                                                name="pac"
                                                type="text"
                                                class="form-control edit-profile bg-light text-secondary"
                                                id="pac"
                                                value="{{ optional($user->pac)->pac ?? '' }}"
                                                readonly
                                            />
                                        </div>
                                            </div>
                                            <!--<div class="row mb-3">-->
                                            <!--    <label for="level" class="col-md-4 col-lg-3 col-form-label">-->
                                            <!--        {{ __('Jenjang Kaderisasi') }}-->
                                            <!--    </label>-->
                                            <!--    <div class="col-md-8 col-lg-9">-->
                                            <!--        <input-->
                                            <!--            name="job"-->
                                            <!--            type="text"-->
                                            <!--            class="form-control edit-profile"-->
                                            <!--            id="level"-->
                                            <!--            value="{{ $user->cadre_level }}"-->
                                            <!--            readonly-->
                                            <!--        />-->
                                            <!--    </div>-->
                                            <!--</div>-->

                                            <!--<div class="row mb-3">-->
                                            <!--    <label for="gender" class="col-md-4 col-lg-3 col-form-label">-->
                                            <!--        {{ __('Jenis Kelamin') }}-->
                                            <!--    </label>-->
                                            <!--    <div class="col-md-8 col-lg-9">-->
                                            <!--        <select class="form-select" name="gender" aria-label="gender">-->
                                            <!--            <option disabled selected>{{ __('-- Pilih --') }}</option>-->
                                            <!--            @foreach ($genders as $value => $label)-->
                                            <!--                <option-->
                                            <!--                    value="{{ $value }}"-->
                                            <!--                    {{ $user->gender == $value ? 'selected' : '' }}-->
                                            <!--                >-->
                                            <!--                    {{ __($label) }}-->
                                            <!--                </option>-->
                                            <!--            @endforeach-->
                                            <!--        </select>-->
                                            <!--    </div>-->
                                            <!--</div>-->

<!--                                            <div class="row mb-3">-->
<!--                                                <label for="address" class="col-md-4 col-lg-3 col-form-label">-->
<!--                                                    {{ __('Alamat Lengkap') }}-->
<!--                                                </label>-->
<!--                                                <div class="col-md-8 col-lg-9">-->
<!--                                                    <textarea-->
<!--                                                        name="address"-->
<!--                                                        class="form-control edit-profile"-->
<!--                                                        id="address"-->
<!--                                                        required-->
<!--                                                    >-->
<!--{{ $user->address }}</textarea-->
<!--                                                    >-->
<!--                                                    <p class="text-danger"></p>-->
<!--                                                </div>-->
<!--                                            </div>-->

<!--                                            <div class="row mb-3">-->
<!--                                                <label for="date_of_birth" class="col-md-4 col-lg-3 col-form-label">-->
<!--                                                    {{ __('Tanggal Lahir') }}-->
<!--                                                </label>-->
<!--                                                <div class="col-md-8 col-lg-9">-->
<!--                                                    <input-->
<!--                                                        name="date_of_birth"-->
<!--                                                        type="date"-->
<!--                                                        class="form-control edit-profile"-->
<!--                                                        id="dateOfBirth"-->
<!--                                                        value="{{ $user->date_of_birth }}"-->
<!--                                                        required-->
<!--                                                    />-->
<!--                                                </div>-->
<!--                                            </div>-->

<!--                                            <div class="row mb-3">-->
<!--                                                <label for="highschool" class="col-md-4 col-lg-3 col-form-label">-->
<!--                                                    {{ __('SMA/SMK/MA/Sederajat') }}-->
<!--                                                </label>-->
<!--                                                <div class="col-md-8 col-lg-9">-->
<!--                                                    <input-->
<!--                                                        name="highschool"-->
<!--                                                        type="text"-->
<!--                                                        class="form-control edit-profile"-->
<!--                                                        id="highschool"-->
<!--                                                        value="{{ $user->highschool }}"-->
<!--                                                        required-->
<!--                                                    />-->
<!--                                                </div>-->
<!--                                            </div>-->

<!--                                            <div class="row mb-3">-->
<!--                                                <label for="grad_year" class="col-md-4 col-lg-3 col-form-label">-->
<!--                                                    {{ __('Tahun Lulus SMA/SMK/MA/Sederajat') }}-->
<!--                                                </label>-->
<!--                                                <div class="col-md-8 col-lg-9">-->
<!--                                                    <select-->
<!--                                                        name="grad_year"-->
<!--                                                        class="edit-profile form-select"-->
<!--                                                        id="gradYear"-->
<!--                                                        required-->
<!--                                                    >-->
<!--                                                        @for ($year = date('Y'); $year >= 1980; $year--)-->
<!--                                                            <option-->
<!--                                                                value="{{ $year }}"-->
<!--                                                                {{ $user->grad_year == $year ? 'selected' : '' }}-->
<!--                                                            >-->
<!--                                                                {{ $year }}-->
<!--                                                            </option>-->
<!--                                                        @endfor-->
<!--                                                    </select>-->
<!--                                                </div>-->
<!--                                            </div>-->

<!--                                            <div class="row mb-3">-->
<!--                                                <label for="bachelor_year" class="col-md-4 col-lg-3 col-form-label">-->
<!--                                                    {{ __('Tahun Masuk Kuliah') }}-->
<!--                                                </label>-->
<!--                                                <div class="col-md-8 col-lg-9">-->
<!--                                                    <select-->
<!--                                                        name="bachelor_year"-->
<!--                                                        class="edit-profile form-select"-->
<!--                                                        id="bachelorYear"-->
<!--                                                        required-->
<!--                                                    >-->
<!--                                                        @for ($year = date('Y'); $year >= 1980; $year--)-->
<!--                                                            <option-->
<!--                                                                value="{{ $year }}"-->
<!--                                                                {{ $user->bachelor_year == $year ? 'selected' : '' }}-->
<!--                                                            >-->
<!--                                                                {{ $year }}-->
<!--                                                            </option>-->
<!--                                                        @endfor-->
<!--                                                    </select>-->
<!--                                                </div>-->
<!--                                            </div>-->

<!--                                            <div class="row mb-3">-->
<!--                                                <label for="wa" class="col-md-4 col-lg-3 col-form-label">-->
<!--                                                    {{ __('Nomor WhatsApp') }}-->
<!--                                                </label>-->
<!--                                                <div class="col-md-8 col-lg-9">-->
<!--                                                    <input-->
<!--                                                        name="wa"-->
<!--                                                        type="text"-->
<!--                                                        class="form-control edit-profile"-->
<!--                                                        id="wa"-->
<!--                                                        value="{{ $user->phone }}"-->
<!--                                                        required-->
<!--                                                    />-->
<!--                                                </div>-->
<!--                                            </div>-->

                                            <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-lg-3 col-form-label">
                                            {{ __('Email') }}
                                        </label>
                                        <div class="col-md-8 col-lg-9">
                                            <input
                                                name="email"
                                                type="email"
                                                class="form-control edit-profile mb-4 bg-light text-secondary"
                                                id="email"
                                                value="{{ $user->email }}"
                                                required
                                                readonly
                                            />
                                            <p class="text-danger m-0">
                                                {{ __('Pastikan semua data sudah terisi dengan benar') }}
                                            </p>
                                        </div>
                                            </div>

                                            <div class="text-end">
                                                <a href="{{ route('profile') }}">
                                                    <button type="button" class="btn btn-secondary me-1">
                                                        {{ __('Batal') }}
                                                    </button>
                                                </a>
                                                <button type="submit" class="btn btn-success">
                                                    {{ __('Update') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade pt-3" id="profileSettings">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">{{ __('Buat Postingan') }}</h3>
                                            </div>

                                            <form
                                                role="form"
                                                method="POST"
                                                action="{{ route('profile.post.store') }}"
                                                enctype="multipart/form-data"
                                            >
                                                @csrf
                                                <div class="card-body">
                                                    @include('admins.news.form')
                                                </div>
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Simpan') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade pt-3" id="changePassword">
                                        <form method="POST" action="{{ route('change-password') }}">
                                            @csrf
                                            <div class="row mb-3">
                                                <label for="current_password" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Kata Sandi Saat Ini') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                        name="current_password"
                                                        type="password"
                                                        class="form-control edit-profile @error('current_password') is-invalid @enderror"
                                                        id="currentPassword"
                                                    />
                                                    @error('current_password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="new_password" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Kata Sandi Baru') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                        name="new_password"
                                                        type="password"
                                                        class="form-control edit-profile @error('new_password') is-invalid @enderror"
                                                        id="newPassword"
                                                    />
                                                    @error('new_password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="reenter_password" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Masukkan Ulang Kata Sandi Baru') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                        name="reenter_password"
                                                        type="password"
                                                        class="form-control edit-profile @error('reenter_password') is-invalid @enderror"
                                                        id="reenterPassword"
                                                    />
                                                    @error('reenter_password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Ubah') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script>
        const cancelImg = () => {
            const preview = document.getElementById('previewImg');
            const fileInput = document.getElementById('formFileSm');
            preview.src = '{{ asset('storage/images/' . $user->img) }}';
            fileInput.value = '';
        };
    </script>
@endsection
