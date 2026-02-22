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
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item">{{ $user->role->role }}</li>
                        <li class="breadcrumb-item active">{{ __('Foto') }}</li>
                    </ol>
                </nav>
            </div>

            <section class="section profile">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body pt-3">
                                <ul class="nav nav-tabs nav-tabs-bordered">
                                    <li class="nav-item">
                                        <button
                                                class="nav-link active"
                                                data-bs-toggle="tab"
                                                data-bs-target="#profileStatistic"
                                        >
                                            {{ __('Statistik') }}
                                        </button>
                                    </li>

                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profileSettings">
                                            {{ __('Karya') }}
                                        </button>
                                    </li>

                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#libraryProfile">
                                            {{ __('Perpustakaan') }}
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content pt-2">
                                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                        <form>
                                            <div class="row mb-3">
                                                <label for="profile-image" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Gambar Profil') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <img
                                                            src="{{ asset('assets/images/default.png') }}"
                                                            alt="Profile"
                                                    />
                                                    <div class="pt-2">
                                                        <a
                                                                href="#"
                                                                class="btn btn-primary btn-sm"
                                                                title="Upload new profile image"
                                                        >
                                                            <i class="bi bi-upload"></i>
                                                        </a>
                                                        <a
                                                                href="#"
                                                                class="btn btn-danger btn-sm"
                                                                title="Remove my profile image"
                                                        >
                                                            <i class="bi bi-trash"></i>
                                                        </a>
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
                                                            class="form-control"
                                                            id="name"
                                                            value="Kevin Anderson"
                                                    />
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="company" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Perusahaan') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                            name="company"
                                                            type="text"
                                                            class="form-control"
                                                            id="company"
                                                            value="Lueilwitz, Wisoky and Leuschke"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="job" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Pekerjaan') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                            name="job"
                                                            type="text"
                                                            class="form-control"
                                                            id="job"
                                                            value="Web Designer"
                                                    />
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="country" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Negara') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                            name="country"
                                                            type="text"
                                                            class="form-control"
                                                            id="country"
                                                            value="USA"
                                                    />
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="address" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Alamat') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                            name="address"
                                                            type="text"
                                                            class="form-control"
                                                    <!DOCTYPE html>
                                                    <html>
                                                    <head>
                                                        <meta charset="utf-8" />
                                                        <meta name="csrf-token" content="{{ csrf_token() }}" />

                                                        <title>{{ __('Generate QR Code') }}</title>
                                                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
                                                              rel="stylesheet" />
                                                    </head>

                                                    <body>
                                                    <div class="container mt-4">
                                                        <div class="card text-center align-middle">
                                                            <img
                                                                    src="{{ asset('storage/images/' . $user->img) }}"
                                                                    alt="{{ __('User Image') }}"
                                                                    style="width: 100%; height: 40rem; object-fit: cover"
                                                            />
                                                            <h1>
                                                                {{ __('Benar Bahwasannya sahabat') }} {{ $user->name }} {{ __('dengan NIM/NIK') }}
                                                                : {{ $user->nim }} {{ __('Adalah Kader PC IPNU IPPNU Banyumas') }}
                                                            </h1>
                                                        </div>
                                                    </div>
                                                    </body>
                                                    </html>
                                                    id="address"
                                                    value="A108 Adam Street, New York, NY 535022"
                                                    />
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="phone" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Telepon') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                            name="phone"
                                                            type="text"
                                                            class="form-control"
                                                            id="phone"
                                                            value="(436) 486-3538 x29071"
                                                    />
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="email" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Email') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                            name="email"
                                                            type="email"
                                                            class="form-control"
                                                            id="email"
                                                            value="k.anderson@example.com"
                                                    />
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="x" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Profil X') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                            name="twitter"
                                                            type="text"
                                                            class="form-control"
                                                            id="x"
                                                            value="https://twitter.com/#"
                                                    />
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="fb" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Profil Facebook') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                            name="fb"
                                                            type="text"
                                                            class="form-control"
                                                            id="fb"
                                                            value="https://facebook.com/#"
                                                    />
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="ig" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Profil Instagram') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                            name="ig"
                                                            type="text"
                                                            class="form-control"
                                                            id="ig"
                                                            value="https://instagram.com/#"
                                                    />
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="linkedin" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Profil LinkedIn') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                            name="linkedin"
                                                            type="text"
                                                            class="form-control"
                                                            id="linkedin"
                                                            value="https://linkedin.com/#"
                                                    />
                                                </div>
                                            </div>

                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Simpan') }}
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

                                    <div class="tab-pane fade pt-3" id="libraryProfile">
                                        <div class="card info-card sales-card">
                                            <div class="container">
                                                <h4 class="my-4 text-center">{{ __('Tambah Buku Perpustakaan') }}</h4>

                                                <form
                                                        action="{{ route('profile.libraries.store') }}"
                                                        method="POST"
                                                        enctype="multipart/form-data"
                                                >
                                                    @csrf
                                                    <label for="file">
                                                        {{ __('File (PDF/DOCX)') }}
                                                    </label>
                                                    <input
                                                            type="file"
                                                            class="form-control my-4"
                                                            name="file"
                                                            id="file"
                                                            accept="application/pdf,application/vnd.ms-word"
                                                    />

                                                    <label for="img">{{ __('Cover') }}</label>
                                                    <input type="file" class="form-control my-4" name="img" id="img" />
                                                    <div class="my-3"></div>
                                                    <label for="title">{{ __('Judul') }}</label>
                                                    <input
                                                            type="text"
                                                            class="form-control"
                                                            name="title"
                                                            id="title"
                                                            placeholder="Max 15 Huruf"
                                                    />

                                                    <label for="author">{{ __('Penulis') }}</label>
                                                    <input type="text" class="form-control" name="author" id="author" />
                                                    <div class="my-3"></div>

                                                    <label for="publisher">{{ __('Penerbit') }}</label>
                                                    <input
                                                            type="text"
                                                            class="form-control"
                                                            name="publisher"
                                                            id="publisher"
                                                    />
                                                    <div class="my-3"></div>

                                                    <label for="year">{{ __('Tahun Terbit') }}</label>
                                                    <input type="text" class="form-control" name="year" id="year" />
                                                    <div class="my-3"></div>

                                                    <label for="isbn">{{ __('Nomor ISBN') }}</label>
                                                    <input type="text" class="form-control" name="isbn" id="isbn" />
                                                    <div class="my-3"></div>

                                                    <label for="lang">{{ __('Bahasa yang Digunakan') }}</label>
                                                    <input type="text" class="form-control" name="lang" id="lang" />
                                                    <div class="my-3"></div>

                                                    <label for="category">{{ __('Kategori') }}</label>
                                                    <select
                                                            name="category"
                                                            class="form-select"
                                                            required
                                                            aria-label="category"
                                                    >
                                                        <option disabled selected>{{ __(' -- Pilih --') }}</option>
                                                        @foreach ($categories as $id => $title)
                                                            <option value="{{ $id }}">
                                                                {{ $title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="my-3"></div>

                                                    <label for="pages">{{ __('Jumlah Halaman') }}</label>
                                                    <input type="number" class="form-control" name="pages" id="pages" />
                                                    <div class="my-3"></div>

                                                    <label for="description">{{ __('Deskripsi') }}</label>
                                                    <textarea
                                                            name="description"
                                                            class="form-control"
                                                            rows="3"
                                                    ></textarea>
                                                    <div class="my-3"></div>

                                                    <div class="my-3">
                                                        <button type="submit" class="btn btn-primary btn-sm mx-3">
                                                            {{ __('Unggah') }}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade show active pt-3" id="profileStatistic">
                                        <div class="card info-card sales-card">
                                            <div class="container">
                                                <h4 class="my-4 text-center">{{ __('Statistik Saya') }}</h4>
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div
                                                                    id="pieChart"
                                                                    style="min-height: 500px"
                                                                    class="echart"
                                                            ></div>

                                                            <script>
                                                                document.addEventListener('DOMContentLoaded', () => {
                                                                    echarts
                                                                        .init(document.querySelector('#pieChart'))
                                                                        .setOption({
                                                                            title: {
                                                                                left: 'center',
                                                                            },
                                                                            tooltip: {
                                                                                trigger: 'item',
                                                                            },
                                                                            legend: {
                                                                                orient: 'vertical',
                                                                                left: 'left',
                                                                            },
                                                                            series: [
                                                                                {
                                                                                    name: 'Access From',
                                                                                    type: 'pie',
                                                                                    radius: '50%',
                                                                                    data: [
                                                                                        {
                                                                                            value: {{ $postCounts }},
                                                                                            name: '{{ __('Tulisan') }}',
                                                                                        }
                                                                                    ],
                                                                                    emphasis: {
                                                                                        itemStyle: {
                                                                                            shadowBlur: 10,
                                                                                            shadowOffsetX: 0,
                                                                                            shadowColor:
                                                                                                'rgba(0, 0, 0, 0.5)',
                                                                                        },
                                                                                    },
                                                                                },
                                                                            ],
                                                                        });
                                                                });
                                                            </script>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade pt-3" id="profileChangePassword">
                                        <form>
                                            <div class="row mb-3">
                                                <label for="current_password" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Kata Sandi Saat Ini') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                            name="current_password"
                                                            type="password"
                                                            class="form-control"
                                                            id="currentPassword"
                                                    />
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
                                                            class="form-control"
                                                            id="newPassword"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="renew_password" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Masukkan Ulang Kata Sandi Baru') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                            name="renew_password"
                                                            type="password"
                                                            class="form-control"
                                                            id="renewPassword"
                                                    />
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">{{ __('Ubah') }}</button>
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

    <script src="{{ asset('assets/js/admins.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/ckeditor5/build/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/vendor/ckfinder/ckfinder.js') }}"></script>

    <script type="text/javascript">
        ClassicEditor.create(document.querySelector('#content'), {
            ckfinder: {
                uploadUrl:
                    '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
            },
            image: {
                toolbar: [
                    'imageTextAlternative',
                    '|',
                    'imageStyle:alignLeft',
                    'imageStyle:full',
                    'imageStyle:alignRight',
                ],

                styles: ['full', 'alignLeft', 'alignRight'],
            },
            toolbar: {
                items: [
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    'link',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'indent',
                    'outdent',
                    'alignment',
                    '|',
                    'blockQuote',
                    'insertTable',
                    'undo',
                    'redo',
                    'CKFinder',
                    'mediaEmbed',
                ],
            },
            language: 'ru',
            table: {
                contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells'],
            },
        }).catch(function(error) {
            console.error(error);
        });
    </script>
@endsection
