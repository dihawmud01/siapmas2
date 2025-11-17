<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
            crossorigin="anonymous"
        />

        <title>{{ __('Daftar') }}</title>
    </head>

    <body>
        <section class="vh-100" style="background-color: #363636">
            <div class="h-100 container py-5">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-xl-10">
                        <div class="card" style="border-radius: 1rem">
                            <div class="row g-0">
                                <div class="col-md-6 col-lg-5 d-none d-md-block">
                                    <img
                                        style="
                                            width: 100%;
                                            height: 35rem;
                                            object-fit: cover;
                                            border-radius: 1rem 0 0 1rem;
                                        "
                                        src="{{ asset('storage/images/login2.jpg') }}"
                                        alt="{{ __('login form') }}"
                                        class="img-fluid"
                                    />
                                </div>

                                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                    <div class="card-body p-lg-4 p-4 text-black">
                                        <form method="POST" action="{{ route('register'), ['id' => $user->id] }}">
                                            @csrf
                                            @method('PUT')
                                            <div
                                                class="d-flex align-items-center justify-content-center mb-1 pb-1 text-center"
                                            >
                                                <span class="h1 fw-bold mb-4">
                                                    <img
                                                        style="width: 100px; height: 100px; object-fit: cover"
                                                        src="{{ asset('storage/images/logokomi.png') }}"
                                                        alt=""
                                                    />
                                                </span>
                                            </div>

                                            <div class="mb-3 text-center">
                                                <h5>{{ __('Daftar') }}</h5>
                                            </div>

                                            <div class="form-group row mb-1">
                                                <label for="name" class="col-md-4 col-form-label text-md-right">
                                                    {{ __('Nama Lengkap') }}
                                                </label>

                                                <div class="col-md-6">
                                                    <input
                                                        id="name"
                                                        type="text"
                                                        class="form-control"
                                                        name="name"
                                                        value="{{ $user->name }}"
                                                        readonly
                                                        autocomplete="name"
                                                        autofocus
                                                    />

                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row mb-1">
                                                <label for="username" class="col-md-4 col-form-label text-md-right">
                                                    {{ __('Username') }}
                                                </label>

                                                <div class="col-md-6">
                                                    <input
                                                        id="username"
                                                        type="text"
                                                        class="form-control @error('username') is-invalid @enderror"
                                                        name="username"
                                                        value="{{ old('username') }}"
                                                        required
                                                        autocomplete="username"
                                                        autofocus
                                                    />

                                                    @error('username')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row mb-1">
                                                <label for="email" class="col-md-4 col-form-label text-md-right">
                                                    {{ __('Email Aktif') }}
                                                </label>

                                                <div class="col-md-6">
                                                    <input
                                                        id="email"
                                                        type="text"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        name="email"
                                                        value="{{ old('email') }}"
                                                        required
                                                        autocomplete="email"
                                                        autofocus
                                                    />

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row" style="display: none">
                                                <label for="pac_id" class="col-md-4 col-form-label text-md-right">
                                                    {{ __('PAC/Komisariat') }}
                                                </label>
                                                <div class="col-md-6">
                                                    <select id="pacId" name="pac_id" class="form-select">
                                                        <option disabled selected>--{{ __('-- Pilih --') }}--</option>

                                                        @foreach ($pacList as $idx => $label)
                                                            <option
                                                                value="{{ $idx }}"
                                                                {{ $user->pac_id == $idx ? 'selected' : '' }}
                                                            >
                                                                {{ __(ucwords($label) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-1">
                                                <label for="nim" class="col-md-4 col-form-label text-md-right">
                                                    {{ __('NIM') }}
                                                </label>

                                                <div class="col-md-6">
                                                    <input
                                                        id="nim"
                                                        type="number"
                                                        readonly
                                                        value="{{ $user->nim }}"
                                                        class="form-control @error('nim') is-invalid @enderror"
                                                        name="nim"
                                                        autocomplete="nim"
                                                    />

                                                    @error('nim')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row mb-1">
                                                <label for="password" class="col-md-4 col-form-label text-md-right">
                                                    {{ __('Kata Sandi') }}
                                                </label>

                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <input
                                                            id="password"
                                                            type="password"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            name="password"
                                                            required
                                                            autocomplete="new-password"
                                                        />

                                                        <button
                                                            type="button"
                                                            id="togglePassword"
                                                            class="btn btn-primary"
                                                        >
                                                            <i id="toggleIcon" class="fa fa-eye"></i>
                                                        </button>
                                                    </div>
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row mb-1">
                                                <label
                                                    for="password_confirmation"
                                                    class="col-md-4 col-form-label text-md-right"
                                                >
                                                    {{ __('Konfirmasi Kata Sandi') }}
                                                </label>

                                                <div class="col-md-6">
                                                    <input
                                                        id="passwordConfirmation"
                                                        type="password"
                                                        class="form-control"
                                                        name="password_confirmation"
                                                        required
                                                    />
                                                </div>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-4">
                                                    <button type="submit" class="btn btn-primary btn-block">
                                                        {{ __('Daftar') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script>
            document.getElementById('togglePassword').addEventListener('click', function () {
                const passwordField = document.getElementById('password');
                const passwordIcon = document.getElementById('toggleIcon');

                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    passwordIcon.classList.replace('fa-eye', 'fa-eye-slash');
                } else {
                    passwordField.type = 'password';
                    passwordIcon.classList.replace('fa-eye-slash', 'fa-eye');
                }
            });
        </script>
    </body>
</html>
