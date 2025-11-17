<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />

        <title>@yield('title') | {{ __('SIAPMAS') }}</title>
        <meta content="" name="description" />
        <meta content="" name="keywords" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <link href="{{ asset('assets/images/favicon.png') }}" rel="icon" />

        <link href="https://fonts.gstatic.com" rel="preconnect" />

        @vite(['resources/js/app.js', 'resources/css/admin.css'])

        @stack('script')
    </head>

    <body>
        <div id="preloader"></div>

        @include('admins.partials._sidebar')
        @include('admins.partials._topbar')

        <main id="main" class="main">
            <div class="pagetitle">
                {{-- <h1 class="">@yield('page_title', __('Default'))</h1> --}}
                {{-- <nav> --}}
                {{-- <ol class="breadcrumb"> --}}
                {{-- <li class="breadcrumb-item"> --}}
                {{-- <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a> --}}
                {{-- </li> --}}
                {{-- @if (Route::is('makesta') || Route::is('lakmud') || Route::is('lakut') || Route::is('latinpel') || Route::is('dashboard.letters.*')) --}}
                {{-- <li class="breadcrumb-item">@yield('path', __('Default'))</li> --}}
                {{-- <li class="breadcrumb-item active text-success"> --}}
                {{-- @yield('page_title', __('Default')) --}}
                {{-- </li> --}}
                {{-- @elseif (Route::is('news.edit')) --}}
                {{-- <li class="breadcrumb-item">@yield('page_title', __('Default'))</li> --}}
                {{-- <li class="breadcrumb-item active text-success">@yield('path', __('Default'))</li> --}}
                {{-- @else --}}
                {{-- <li class="breadcrumb-item active text-success"> --}}
                {{-- @yield('page_title', __('Default')) --}}
                {{-- </li> --}}
                {{-- @endif --}}
                {{-- </ol> --}}
                {{-- </nav> --}}
            </div>

            <section class="section dashboard">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div>
                            @yield('content')
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center rounded-circle">
            <i class="bi bi-arrow-up-short"></i>
        </a>

        @include('admins.partials._footer')
        @include('admins.partials._script')

        <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
        <script src="{{ asset('js/admin.js') }}"></script>

        @include('sweetalert::alert')
    </body>
</html>
