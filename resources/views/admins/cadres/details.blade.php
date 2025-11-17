<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>{{ __('Detail Kader') }}</title>
    </head>
    <body>
        <h1>{{ __('Detail Kader') }}</h1>
        @foreach ($cadres as $cadre)
            <form action="" method="post">
                <label for="name">{{ __('Nama') }}:</label>
                <input type="text" id="name" readonly value="{{ $cadre['name'] }}" />
            </form>
        @endforeach
    </body>
</html>
