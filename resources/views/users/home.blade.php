@extends('users.layout')

@section('title')
    {{ __('Home') }}
@endsection

@push('script')
    @vite(['resources/js/plugins/apexcharts.js', 'resources/js/plugins/echarts.js', 'resources/js/plugins/purecounter.js', 'resources/js/plugins/swiper.js'])
@endpush

@section('content')
    <section id="hero" class="mb-5">
        <div class="hero-container">
            <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
                <ol id="hero-carousel-indicators" class="carousel-indicators"></ol>

                <div class="carousel-inner align-items-center justify-content-center" role="listbox">
                    <div
                        class="carousel-item active"
                        style="background-image: url({{ asset('assets/images/bg.jpeg') }})"
                    >
                        <div class="carousel-container">
                            <div class="container">
                                <h2 class="animate__animated animate__fadeInDown mb-2">
                                    {{ __('Selamat Datang') }}
                                    <br />
                                    {{ __('Di Website PC IPNU IPPNU BANYUMAS') }}
                                </h2>
                                <a
                                    href="{{ route('login') }}"
                                    class="btn btn-success btn-lg rounded-4 fw-semibold text-decoration-none p-4"
                                >
                                    {{ __('Mulai Sekarang') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    @foreach ($home as $value)
                        <div
                            class="carousel-item"
                            style="background-image: url({{ asset('storage/images/' . $value->img) }})"
                        >
                            <div class="carousel-container">
                                <div class="container">
                                    <h2 class="animate__animated animate__fadeInDown mb-2">{{ $value['title'] }}</h2>
                                    <a
                                        href="{{ route('login') }}"
                                        class="btn btn-success btn-lg rounded-4 fw-semibold text-decoration-none p-4"
                                    >
                                        {{ __('Mulai Sekarang') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
                </a>

                <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
                </a>
            </div>
        </div>
    </section>

    <section id="about" class="my-5 px-3">
        <div class="container" data-aos="fade-up">
            <header class="section-header text-center">
                <h3 class="fw-bold">{{ __('Tentang Kami') }}</h3>
            </header>

            <h6 class="p-4 text-center">
                {{ __('Pimpinan Cabang IPNU IPPNU Banyumas merupakan wadah kaderisasi pelajar Nahdlatul Ulama di wilayah Banyumas. Kami berkomitmen untuk mencetak generasi muda yang berilmu, berakhlak, dan berdaya saing tinggi melalui berbagai program pendidikan, pengembangan potensi, dan penguatan nilai-nilai ke-NU-an serta kebangsaan. Bersama IPNU IPPNU, pelajar Banyumas siap berkontribusi aktif untuk bangsa dan agama.') }}
            </h6>
        </div>
    </section>

    <section id="facts" class="my-5 p-5">
        <div class="container" data-aos="fade-up">
            <header class="section-header text-center">
                <h3 class="fw-bold">{{ __('Data Anggota IPNU IPPNU di Banyumas') }}</h3>
            </header>

            <div class="row counters p-4 text-center">
                <div class="col-12 col-md-4">
                    <span
                        data-purecounter-start="0"
                        data-purecounter-end="{{ $formalMemberLevelCounts['makesta'] }}"
                        data-purecounter-duration="6"
                        class="purecounter"
                    ></span>
                    <p>{{ __('Kader Makesta') }}</p>
                </div>

                <div class="col-12 col-md-4">
                    <span
                        data-purecounter-start="0"
                        data-purecounter-end="{{ $formalMemberLevelCounts['lakmud'] }}"
                        data-purecounter-duration="5"
                        class="purecounter"
                    ></span>
                    <p>{{ __('Kader Lakmud') }}</p>
                </div>

                <div class="col-12 col-md-4">
                    <span
                        data-purecounter-start="0"
                        data-purecounter-end="{{ $formalMemberLevelCounts['lakut'] }}"
                        data-purecounter-duration="4"
                        class="purecounter"
                    ></span>
                    <p>{{ __('Kader Lakut') }}</p>
                </div>
            </div>
        </div>
    </section>

    <div class="col-12 p-4" data-aos="fade-up">
        <div class="card mt-5">
            <div class="card-body pt-5">
                <h4 class="card-title text-center">
                    {{ __('Data Rekan & Rekanita') }}
                    <span>{{ __('Dari Tahun Ke Tahun') }}</span>
                </h4>
                <div id="reportsChart"></div>
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const makestaCounts = @json($makestaCounts);
                        const lakmudCounts = @json($lakmudCounts);
                        const lakutCounts = @json($lakutCounts);
                        const years = [
                            '2016',
                            '2017',
                            '2018',
                            '2019',
                            '2020',
                            '2021',
                            '2022',
                            '2023',
                            '2024',
                            '2025',
                            '2026',
                        ];
                        const makestaData = years.map((year) => makestaCounts[year] || 0);
                        const lakmudData = years.map((year) => lakmudCounts[year] || 0);
                        const lakutData = years.map((year) => lakutCounts[year] || 0);

                        new ApexCharts(document.querySelector('#reportsChart'), {
                            series: [
                                { name: '{{ __('Makesta') }}', data: makestaData },
                                { name: '{{ __('Lakmud') }}', data: lakmudData },
                                { name: '{{ __('Lakut') }}', data: lakutData },
                            ],
                            chart: { height: 350, type: 'area', toolbar: { show: false } },
                            markers: { size: 4 },
                            colors: ['#5CB338', '#ECE852', '#FB4141'],
                            fill: {
                                type: 'gradient',
                                gradient: { shadeIntensity: 1, opacityFrom: 0.3, opacityTo: 0.4, stops: [0, 90, 100] },
                            },
                            dataLabels: { enabled: false },
                            stroke: { curve: 'smooth', width: 2 },
                            xaxis: { type: 'datetime', categories: years },
                            tooltip: { x: { format: 'yyyy' } },
                            legend: { offsetY: 20, height: 52 },
                        }).render();
                    });
                </script>
            </div>
        </div>
    </div>

    <div class="col-12 p-4" data-aos="fade-up">
        <div class="card">
            <div class="card-body pt-5">
                <h4 class="card-title text-center">{{ __('Kader Berdasarkan Jenis Kelamin') }}</h4>
                <div
                    id="trafficChart"
                    style="min-height: 400px"
                    class="echart d-flex justify-content-center align-items-center mb-5"
                ></div>
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        echarts.init(document.querySelector('#trafficChart')).setOption({
                            tooltip: { trigger: 'item' },
                            legend: { bottom: '0', left: 'center', orient: 'horizontal' },
                            series: [
                                {
                                    name: '{{ __('Jenis Kelamin') }}',
                                    type: 'pie',
                                    radius: ['40%', '70%'],
                                    avoidLabelOverlap: false,
                                    label: { show: false, position: 'center' },
                                    emphasis: { label: { show: true, fontSize: '18', fontWeight: 'bold' } },
                                    labelLine: { show: false },
                                    data: [
                                        { value: {{ $genderCounts['female'] }}, name: '{{ __('Kader Perempuan') }}' },
                                        { value: {{ $genderCounts['male'] }}, name: '{{ __('Kader Laki-Laki') }}' },
                                    ],
                                },
                            ],
                        });
                    });
                </script>
            </div>
        </div>
    </div>

<div class="col-12 p-4" data-aos="fade-up">
    <div class="card shadow">
        <div class="card-body pt-5">
            <h4 class="card-title text-center mb-4 fw-bold text-success">
                {{ __('Kader Berdasarkan PAC/Komisariat') }}
            </h4>

            {{-- Tabel Kader --}}
            <div class="table-responsive mb-4">
                <table class="table table-hover table-bordered align-middle" id="kaderTable">
                    <thead class="table-success text-center">
                        <tr>
                            <th>No</th>
                            <th>PAC/Komisariat</th>
                            <th>Jumlah Kader</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $pacList = [
                                'PAC BATURRADEN',
                                'PAC CILONGOK',
                                'PAC KEDUNGBANTENG',
                                'PAC KARANGLEWAS',
                                'PAC PURWOJATI',
                                'PAC PURWOKERTO BARAT',
                                'PAC PURWOKERTO TIMUR',
                                'PAC PURWOKERTO UTARA',
                                'PAC PURWOKERTO SELATAN',
                                'PAC SUMBANG',
                                'PAC SOKARAJA',
                                'PAC KEMBARAN',
                                'PAC TAMBAK',
                                'PAC SOMAGEDE',
                                'PAC BANYUMAS',
                                'PAC KEMRANJEN',
                                'PAC GUMELAR',
                                'PAC AJIBARANG',
                                'PAC PEKUNCEN',
                                'PAC WANGON',
                                'PAC RAWALO',
                                'PAC JATILAWANG',
                                'PAC KEBASEN',
                                'PAC PATIKRAJA',
                                'PAC KALIBAGOR',
                                'PAC LUMBIR',
                                'PAC SUMPIUH',
                                'PKPT UNU PURWOKERTO',
                                'PKPT UIN SAIZU PURWOKERTO',
                            ];

                            // Bangun array kombinasi PAC + jumlah kader, lalu urutkan abjad
                            $dataList = [];
                            foreach ($pacCounts as $index => $count) {
                                $name = $pacList[$index - 1] ?? 'Tidak Diketahui';
                                $dataList[] = ['nama' => $name, 'jumlah' => $count];
                            }

                            // Urutkan berdasar nama PAC
                            usort($dataList, fn($a, $b) => strcmp($a['nama'], $b['nama']));
                        @endphp

                        @foreach($dataList as $i => $item)
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td>{{ $item['nama'] }}</td>
                                <td class="text-center">{{ $item['jumlah'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>


    <section id="news" class="section-bg p-5">
        <div class="container" data-aos="fade-up">
            <header class="section-header pt-5 text-center">
                <h3 class="fw-bold">{{ __('Berita Terkini') }}</h3>
            </header>
            <div class="row news-container mt-4 p-4" data-aos="fade-up" data-aos-delay="200">
                @foreach ($recentNews->take(3) as $news)
                    <div class="col-12 col-md-6 col-lg-4 news-item filter-app mb-4">
                        <div class="news-wrap">
                            <figure>
                                <a href="{{ route('news.show', ['slug' => $news->slug]) }}">
                                    <img
                                        src="{{ asset('storage/images/' . $news->img) }}"
                                        class="img-fluid rounded-1"
                                        alt="{{ $news->title }}"
                                        style="
                                            width: 100%;
                                            height: 250px;
                                            object-fit: cover;
                                            box-shadow: 0 0 30px rgba(1, 41, 112, 0.1);
                                        "
                                    />
                                </a>
                                <a
                                    href="{{ asset('storage/images/' . $news->img) }}"
                                    data-lightbox="news"
                                    data-title="{{ $news->title }}"
                                    class="link-preview"
                                >
                                    <i class="bi bi-plus text-dark"></i>
                                </a>
                                <a
                                    href="{{ route('news.show', ['slug' => $news->slug]) }}"
                                    class="link-details"
                                    title="More Details"
                                >
                                    <i class="bi bi-link text-dark"></i>
                                </a>
                            </figure>

                            <div class="news-info text-center">
                                <a
                                    href="{{ route('news.show', ['slug' => $news->slug]) }}"
                                    class="text-decoration-none"
                                >
                                    <h4 class="text-dark">{{ Str::limit($news->title, '35') }}</h4>
                                </a>
                                <a
                                    href="{{ route('categories', ['slug' => $news->category->slug]) }}"
                                    class="text-decoration-none"
                                >
                                    <p class="text-success" style="text-transform: none; text-decoration: none">
                                        {{ $news->category->title }}
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="quote" class="section-bg p-5">
        <div class="container" data-aos="fade-up">
            <header class="section-header text-center">
                <h3 class="fw-bold" style="text-transform: inherit">{{ __('QUOTES OF THE DAY') }}</h3>
            </header>

            <div class="quote-details-slider swiper" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper py-4">
                    @foreach ($quotes as $quote)
                        <div class="swiper-slide d-flex align-items-center justify-content-center">
                            <div class="quote-item d-flex align-items-center flex-column text-center">
                                <img
                                    src="{{ asset('storage/images/' . $quote->img) }}"
                                    class="quote-img rounded-circle mb-3"
                                    alt=""
                                    style="width: 110px; height: 110px; object-fit: cover; border: 4px solid green"
                                />
                                <h3 class="fw-bold">{{ $quote->name }}</h3>
                                <h4>{{ $quote->who }}</h4>
                                <p class="d-flex align-items-center">
                                    <img
                                        src="{{ asset('assets/images/quote-sign-left.png') }}"
                                        class="quote-sign-left me-2"
                                        alt=""
                                    />
                                    {{ $quote->quote }}
                                    <img
                                        src="{{ asset('assets/images/quote-sign-right.png') }}"
                                        class="quote-sign-right ms-2"
                                        alt=""
                                    />
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
@endsection
