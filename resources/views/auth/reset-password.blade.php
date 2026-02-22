<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />

        <title>{{ __('Perbarui Kata Sandi') }}</title>

        @vite(['resources/js/app.js'])
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
                                        src="{{ asset('assets/images/bglogin.png') }}"
                                        alt="form login"
                                        class="img-fluid"
                                        style="
                                            width: 100%;
                                            height: 35rem;
                                            object-fit: cover;
                                            border-radius: 1rem 0 0 1rem;
                                        "
                                    />
                                </div>
                                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                    <div class="card-body p-lg-5 p-4 text-black">
                                        <form method="POST" action="{{ route('password.update') }}">
                                            @csrf
                                            <div
                                                class="d-flex align-items-center justify-content-center mb-6 pb-1 text-center"
                                            >
                                                <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219"></i>
                                                <span class="h1 fw-bold mb-0">
                                                    <img
                                                        style="width: 100px; height: 100px; object-fit: cover"
                                                        src="{{ asset('assets/images/logokomi.png') }}"
                                                        alt=""
                                                    />
                                                </span>
                                            </div>
                                            <h3 class="fw-normal mb-3 pb-3 text-center" style="letter-spacing: 1px">
                                                {{ __('Perbarui Kata Sandi Anda') }}
                                            </h3>
                                            <h6 class="fw-normal mb-3 pb-3 text-center" style="letter-spacing: 1px">
                                                {{ __('Silakan Masukkan Kata Sandi Baru!') }}
                                            </h6>

                                            <div class="form-group" style="display: none">
                                                <input type="text" name="token" value="{{ request()->token }}" />
                                                <input type="text" name="email" value="{{ request()->email }}" />
                                            </div>

                                            <div class="form-group row mb-3">
                                                <label for="password" class="col-md-4 col-form-label text-md-right">
                                                    {{ __('Kata Sandi Baru') }}
                                                </label>

                                                <div class="col-md-6">
                                                    <input
                                                        id="password"
                                                        type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        name="password"
                                                        required
                                                        autocomplete="new-password"
                                                    />

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
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
                                                        autocomplete="new-password"
                                                    />
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-center mb-4 mt-3 pt-1">
                                                <button class="btn btn-success btn-lg" type="submit">
                                                    {{ __('Perbarui Kata Sandi') }}
                                                </button>
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

        <script type="text/javascript">
            window.onload = function () {
                document.getElementById('password').onchange = validatePassword;
                document.getElementById('passwordConfirmation').onchange = validatePassword;
            };

            function validatePassword() {
                let pass2 = document.getElementById('passwordConfirmation').value;
                let pass1 = document.getElementById('password').value;
                if (pass1 !== pass2)
                    document
                        .getElementById('passwordConfirmation')
                        .setCustomValidity('{{ __('Kata Sandi Tidak Sama, Coba Lagi') }}');
                else document.getElementById('passwordConfirmation').setCustomValidity('');
            }
        </script>

        @include('sweetalert::alert')
    </body>
</html>
