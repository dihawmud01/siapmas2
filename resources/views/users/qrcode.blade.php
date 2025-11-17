<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ __('Generate QR Code') }}</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <div class="container mt-4">
            <div class="card text-center align-middle">
                <img
                    src="{{ asset('storage/images/' . $users->img) }}"
                    alt="{{ __('User Image') }}"
                    style="width: 100%; height: 40rem; object-fit: cover"
                />
                <h1>
                    {{ __('Benar Bahwasannya sahabat') }} {{ $users->name }} {{ __('dengan NIM/NIK') }} :
                    {{ $users->nim }} {{ __('Adalah Kader PC IPNU IPPNU Banyumas') }}
                </h1>
            </div>
        </div>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
