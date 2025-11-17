<header id="header" class="header fixed-top d-flex align-items-center px-4 py-5">
    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center text-decoration-none">
            <div class="d-flex align-items-center">
                <img class="img-fluid" src="{{ asset('assets/images/logokomi.png') }}" alt="{{ __('Logo') }}" />
                <div class="logo-text d-flex flex-column ms-2">
                    <h1 class="logo-text-main fw-bold fs-2 m-0">{{ __('SIAPMAS') }}</h1>
                    <span class="logo-text-secondary text-secondary fw-normal lh-1">
                        {{ __('Sistem Informasi Administrasi Pelajar NU Banyumas') }}
                    </span>
                </div>
            </div>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <div class="search-bar"></div>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item dropdown">
                <a
                    class="{{-- dropdown --}} d-flex align-items-center text-decoration-none"
                    href="{{ route('logout') }}"
                >
                    <i class="bi bi-box-arrow-right btn btn-danger m-4"><span>{{ __(' Keluar') }}</span></i>
                </a>
            </li>
        </ul>
    </nav>
</header>
