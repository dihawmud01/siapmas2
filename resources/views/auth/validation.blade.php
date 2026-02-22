<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />

        <title>{{ __('Masuk') }}</title>

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
                                        alt="login form"
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
                                        <form method="POST" action="{{ route('validation') }}">
                                            @csrf
                                            <div
                                                class="d-flex align-items-center justify-content-center mb-6 pb-1 text-center"
                                            >
                                                <span class="h1 fw-bold mb-0">
                                                    <img
                                                        style="width: 100px; height: 100px; object-fit: cover"
                                                        src="{{ asset('assets/images/logokomi.png') }}"
                                                        alt=""
                                                    />
                                                </span>
                                            </div>

                                            <h5 class="fw-normal mb-3" style="letter-spacing: 1px">
                                                {{ __('Masukkan NIM') }}
                                            </h5>

                                            <div class="form-outline mb-2">
                                                <input
                                                    type="text"
                                                    placeholder=""
                                                    name="nim"
                                                    id="nim"
                                                    autofocus
                                                    class="form-control form-control-lg"
                                                />
                                            </div>

                                            <div class="form-outline">
                                                @if (Session::has('error'))
                                                    <div class="alert alert-danger">
                                                        {{ Session::get('error') }}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="d-flex justify-content-between mb-4 pt-1">
                                                <a href="{{ route('login') }}" class="btn btn-warning btn-lg">
                                                    {{ __('Kembali') }}
                                                </a>
                                                <div>
                                                    <button class="btn btn-success btn-lg" type="submit">
                                                        {{ __('Lanjutkan') }}
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
            let passwordInput = document.getElementById('form2Example27');
            let toggleButton = document.getElementById('togglePassword');
            let toggleIcon = document.getElementById('toggleIcon');

            toggleButton.addEventListener('click', function () {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleIcon.classList.remove('fa fa-eye');
                    toggleIcon.classList.add('fa fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    toggleIcon.classList.remove('fa fa-eye-slash');
                    toggleIcon.classList.add('fa fa-eye');
                }
            });
        </script>

        @include('sweetalert::alert')
    </body>
</html>
