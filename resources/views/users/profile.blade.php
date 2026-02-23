@section('title')
    {{ __('Profil Saya') }}
@endsection

@extends('users.layout')

@section('content')
    <div style="background-color: #f8f9fa; min-height: 100vh; padding-top: 5rem; padding-bottom: 3rem">
        <!-- Hero / Cover Banner -->
        <div
            class="position-relative"
            style="height: 250px; background: linear-gradient(135deg, #0e5a31 0%, #178a4b 100%)"
        >
            <div
                class="position-absolute w-100 h-100 start-0 top-0"
                style="
                    background-image: url(&quot;data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E&quot;);
                "
            ></div>
        </div>

        <div class="container" style="margin-top: -100px">
            <div class="row g-4">
                <!-- Profile Sidebar (Kiri) -->
                <div class="col-lg-4 col-xl-4 mb-4">
                    <div class="card rounded-4 position-relative z-index-1 border-0 pb-4 text-center shadow-sm">
                        <div class="card-body mt-n4">
                            <div class="d-inline-block position-relative mb-3" style="margin-top: -40px">
                                <img
                                    src="{{
                                        asset(
                                            $user['photo'] != 'default.png'
                                                ? 'storage/images/user/photos/' . $user['id'] . '/' . $user['photo']
                                                : 'storage/images/default.png',
                                        )
                                    }}"
                                    class="rounded-circle border-5 border border-white bg-white"
                                    style="
                                        width: 160px;
                                        height: 160px;
                                        object-fit: cover;
                                        z-index: 10;
                                        position: relative;
                                        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
                                    "
                                    alt="Foto Profil"
                                />

                                @if ($profile->check == '1')
                                    <span
                                        class="position-absolute bg-success rounded-circle bottom-0 end-0 border border-2 border-white p-2 shadow-sm"
                                        style="z-index: 20; transform: translate(-10px, -10px)"
                                        data-bs-toggle="tooltip"
                                        title="Akun Terverifikasi"
                                    >
                                        <i class="bi bi-patch-check-fill fs-5 text-white"></i>
                                        <span class="visually-hidden">Terverifikasi</span>
                                    </span>
                                @endif
                            </div>

                            <h4 class="fw-bold text-dark mb-1">{{ $profile->name }}</h4>
                            <p class="text-secondary mb-3">{{ '@' . $profile->username }}</p>

                            @if (isset($profile->role->role))
                                <span
                                    class="badge bg-success text-success border-success rounded-pill mb-4 border bg-opacity-10 px-3 py-2"
                                    style="font-weight: 500"
                                >
                                    <i class="bi bi-shield-check me-1"></i>
                                    {{ $profile->role->role }}
                                </span>
                            @endif

                            <div class="mb-4">
                                <a
                                    href="{{ route('account') }}"
                                    class="btn btn-dark rounded-pill w-75 hover-lift px-4 shadow-sm"
                                >
                                    <i class="bi bi-pencil-square me-2"></i>
                                    {{ __('Edit Profil Anda') }}
                                </a>
                            </div>

                            <hr class="text-muted mx-4 opacity-25" />

                            <div class="mt-4 px-4 text-start">
                                <!-- BIO -->
                                <div class="mb-4">
                                    <h6
                                        class="text-success text-uppercase fw-bold mb-2"
                                        style="font-size: 0.75rem; letter-spacing: 1px"
                                    >
                                        Biografi Singkat
                                    </h6>
                                    <p class="text-secondary mb-0" style="font-size: 0.95rem; line-height: 1.6">
                                        {{ $profile->bio ?: 'Belum ada kutipan atau biografi yang ditambahkan.' }}
                                    </p>
                                </div>

                                <!-- KONTAK -->
                                <div class="mb-4">
                                    <h6
                                        class="text-success text-uppercase fw-bold mb-3"
                                        style="font-size: 0.75rem; letter-spacing: 1px"
                                    >
                                        Kontak Informatif
                                    </h6>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-light text-success me-3 rounded p-2 shadow-sm">
                                            <i class="bi bi-envelope"></i>
                                        </div>
                                        <div class="text-truncate">
                                            <div class="text-dark fw-medium" style="font-size: 0.95rem">
                                                {{ $profile->email }}
                                            </div>
                                            <div class="text-muted" style="font-size: 0.8rem">Email Utama</div>
                                        </div>
                                    </div>
                                    @if ($profile->phone)
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light text-success me-3 rounded p-2 shadow-sm">
                                                <i class="bi bi-whatsapp"></i>
                                            </div>
                                            <div>
                                                <div class="text-dark fw-medium" style="font-size: 0.95rem">
                                                    {{ $profile->phone }}
                                                </div>
                                                <div class="text-muted" style="font-size: 0.8rem">
                                                    Telepon / WhatsApp
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- ORGANISASI -->
                                @if (optional($profile->pac)->pac)
                                    <div class="mb-3">
                                        <h6
                                            class="text-success text-uppercase fw-bold mb-3"
                                            style="font-size: 0.75rem; letter-spacing: 1px"
                                        >
                                            Unit Kerja (PAC/Komi)
                                        </h6>
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="bg-light text-success me-3 rounded p-2 shadow-sm">
                                                <i class="bi bi-pin-map-fill"></i>
                                            </div>
                                            <div>
                                                <div class="text-dark fw-medium" style="font-size: 0.95rem">
                                                    {{ $profile->pac->pac }}
                                                </div>
                                                <div class="text-muted" style="font-size: 0.8rem">
                                                    Struktur Pengurus
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content / News (Kanan) -->
                <div class="col-lg-8 col-xl-8">
                    <!-- Statistik Bar -->
                    <div class="card rounded-4 mb-4 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="bg-success text-success rounded-circle me-3 bg-opacity-10 p-3">
                                        <i class="bi bi-newspaper fs-4"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold text-dark mb-0">Postingan Saya</h5>
                                        <p class="text-muted small mb-0">
                                            Total karya jurnalistik atau berita yang telah Anda publikasikan.
                                        </p>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <h2 class="fw-bold text-success lh-1 mb-0">{{ $postCounts }}</h2>
                                    <span
                                        class="text-muted small text-uppercase fw-semibold"
                                        style="letter-spacing: 1px"
                                    >
                                        Artikel
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tautan Tambahan Jika Admin -->
                    @auth
                        @if (in_array(auth()->user()->role_id, [1, 2, 3]))
                            <div class="d-flex justify-content-end mb-4 gap-2">
                                <a
                                    href="{{ route('uploads') }}"
                                    class="btn btn-primary rounded-pill hover-lift px-4 shadow-sm"
                                >
                                    <i class="bi bi-plus-lg me-2"></i>
                                    {{ __('Tulis Berita Baru') }}
                                </a>
                            </div>
                        @endif
                    @endauth

                    <!-- Daftar Berita / News -->
                    <div class="d-flex align-items-center mb-4">
                        <h5 class="fw-bold text-dark mb-0">
                            <i class="bi bi-journal-text text-success me-2"></i>
                            Koleksi Artikel Terbaru
                        </h5>
                        <div class="flex-grow-1 ms-3" style="height: 1px; background-color: #dee2e6"></div>
                    </div>

                    @if ($news && $news->count() > 0)
                        <div class="row row-cols-1 row-cols-md-2 g-4 mb-5">
                            @foreach ($news as $item)
                                <div class="col">
                                    <div class="card h-100 rounded-4 card-hover overflow-hidden border-0 shadow-sm">
                                        <div class="position-absolute z-index-1 end-0 top-0 p-3">
                                            @if ($item->category)
                                                <span
                                                    class="badge bg-dark rounded-pill fw-medium px-3 py-2 shadow-sm"
                                                    style="
                                                        backdrop-filter: blur(4px);
                                                        background-color: rgba(33, 37, 41, 0.75) !important;
                                                        border: 1px solid rgba(255, 255, 255, 0.2);
                                                    "
                                                >
                                                    {{ $item->category->title }}
                                                </span>
                                            @endif
                                        </div>

                                        @if ($item->image)
                                            <img
                                                src="{{ asset('storage/images/' . $item->image) }}"
                                                class="card-img-top"
                                                alt="{{ $item->title }}"
                                                style="height: 220px; object-fit: cover"
                                            />
                                        @else
                                            <div
                                                class="card-img-top bg-light d-flex align-items-center justify-content-center"
                                                style="height: 220px"
                                            >
                                                <div class="text-muted text-center">
                                                    <i class="bi bi-image fs-1 d-block mb-2 opacity-25"></i>
                                                    <small>Tanpa Thumbnail</small>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="card-body d-flex flex-column p-4">
                                            <h5
                                                class="card-title fw-bold text-dark lh-base mb-3"
                                                style="
                                                    display: -webkit-box;
                                                    -webkit-line-clamp: 2;
                                                    -webkit-box-orient: vertical;
                                                    overflow: hidden;
                                                "
                                            >
                                                {{ $item->title }}
                                            </h5>
                                            <p
                                                class="card-text text-secondary small flex-grow-1 mb-4"
                                                style="line-height: 1.6"
                                            >
                                                {{ Str::limit(html_entity_decode(strip_tags($item->content)), 120, '...') }}
                                            </p>

                                            <div
                                                class="d-flex justify-content-between align-items-center border-top border-light mt-auto pt-3"
                                            >
                                                <div class="text-muted small d-flex align-items-center fw-medium">
                                                    <i class="bi bi-calendar-event text-success me-2"></i>
                                                    {{ $item->created_at->translatedFormat('d M Y') }}
                                                </div>
                                                <a
                                                    href="{{ route('news.show', $item->slug) }}"
                                                    class="btn btn-sm btn-outline-success rounded-pill fw-medium px-3"
                                                >
                                                    Baca Resolusi
                                                    <i class="bi bi-arrow-right-short ms-1"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div
                            class="card rounded-4 mt-4 border-0 p-5 text-center shadow-sm"
                            style="background-color: #ffffff"
                        >
                            <div class="card-body border-light rounded-4 border border-2 border-dashed py-5">
                                <div
                                    class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center mb-4 bg-opacity-10"
                                    style="width: 100px; height: 100px"
                                >
                                    <i class="bi bi-journal-x display-3 text-success opacity-75"></i>
                                </div>
                                <h4 class="fw-bold text-dark mb-2">Belum Ada Artikel</h4>
                                <p class="text-secondary mx-auto mb-4" style="max-width: 400px; line-height: 1.6">
                                    Anda belum mempublikasikan karya berita, artikel informatif, atau tulisan apa pun di
                                    portal ini.
                                </p>

                                @auth
                                    @if (in_array(auth()->user()->role_id, [1, 2, 3]))
                                        <a
                                            href="{{ route('uploads') }}"
                                            class="btn btn-success rounded-pill px-4 py-2 shadow-sm"
                                        >
                                            <i class="bi bi-plus-lg me-2"></i>
                                            Tulis Berita Pertama
                                        </a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom CSS Extensions for Profile UI Modernization */
        .hover-lift {
            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }
        .hover-lift:hover {
            transform: translateY(-2.5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }
        .card-hover {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.06) !important;
        }
        .z-index-1 {
            z-index: 1;
        }
    </style>
@endsection
