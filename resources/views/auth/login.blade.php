<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />

        <link href="{{ asset('assets/images/favicon.png') }}" rel="icon" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <title>{{ __('Masuk') }}</title>

        @vite(['resources/js/app.js', 'resources/css/login.css'])
    </head>
    <body class="d-flex align-items-center justify-content-center bg-login">
        <div id="preloader"></div>

        <div class="d-flex justify-content-center align-items-center min-vh-100 container">
            <div class="card rounded-4 border-0 shadow-lg" style="max-width: 900px; width: 100%">
                <div class="row g-0">
                    <div class="col-md-6 d-none d-md-block">
                        <img
                            src="{{ asset('storage/images/bglogin.png') }}"
                            class="img-fluid rounded-start h-100"
                            style="object-fit: cover"
                            alt="Login Image"
                        />
                    </div>
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="card-body px-5 py-4">
                            <div class="text-center">
                                <img
                                    src="{{ asset('assets/images/logokomi.png') }}"
                                    alt="Logo"
                                    class="mb-3"
                                    style="width: 80px"
                                />
                                <h5 class="fw-bold">{{ __('Masuk ke akun Anda') }}</h5>
                            </div>

                            <form method="POST" action="{{ route('authenticate') }}">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">{{ __('Email') }}</label>
                                    <input
                                        type="email"
                                        name="email"
                                        class="form-control form-control-lg"
                                        placeholder="Email"
                                        autofocus
                                    />
                                </div>

                                <div class="position-relative mb-3">
                                    <label class="form-label">{{ __('Kata Sandi') }}</label>
                                    <div class="input-group">
                                        <input
                                            type="password"
                                            name="password"
                                            id="password"
                                            class="form-control form-control-lg"
                                            placeholder="Kata Sandi"
                                        />
                                        <button type="button" id="togglePassword" class="btn btn-outline-secondary">
                                            <i id="toggleIcon" class="fa fa-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                @if (Session::has('error'))
                                    <div class="alert alert-danger text-center">
                                        {{ Session::get('error') }}
                                    </div>
                                @endif

                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('index') }}" class="btn btn-outline-success">
                                        {{ __('Kembali') }}
                                    </a>
                                    <button type="submit" class="btn btn-success">{{ __('Masuk') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('togglePassword').addEventListener('click', function () {
                let passwordInput = document.getElementById('password');
                let toggleIcon = document.getElementById('toggleIcon');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleIcon.classList.replace('fa-eye', 'fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    toggleIcon.classList.replace('fa-eye-slash', 'fa-eye');
                }
            });
        </script>
    </body>
</html>
