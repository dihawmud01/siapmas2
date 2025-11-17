@section('title')
    {{ __('Admin') }}
@endsection

@extends('admins.layout')
@section('page_title', __('Overview'))

@push('script')
    @vite(['resources/js/plugins/apexcharts.js'])
@endpush

@section('content')
    <x-breadcrumb :values="[__('Overview')]"></x-breadcrumb>

    <div class="row">
        <div class="col">
            <div class="card info-card sales-card">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold align-items-baseline fs-5 mb-3">
                        {{ __('Kader Makesta') }}
                    </h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center me-3">
                            <i class="bi bi-people"></i>
                        </div>
                        <div>
                            <h6>{{ $formalMemberLevelCounts['makesta'] }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card info-card sales-card">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold align-items-baseline fs-5 mb-3">
                        {{ __('Kader Lakmud') }}
                    </h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center me-3">
                            <i class="bi bi-people"></i>
                        </div>
                        <div>
                            <h6>{{ $formalMemberLevelCounts['lakmud'] }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card info-card revenue-card">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold align-items-baseline fs-5 mb-3">
                        {{ __('Kader Lakut') }}
                    </h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center me-3">
                            <i class="bi bi-people"></i>
                        </div>
                        <div>
                            <h6>{{ $formalMemberLevelCounts['lakut'] }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body p-4">
                    <div class="card-header d-flex justify-content-between align-items-center mb-4 border-0 bg-white">
                        <h5 class="card-title fw-bold d-flex align-items-baseline fs-4 mb-0">
                            {{ __('Data Kader') }}
                        </h5>
                        <div class="dropdown rounded filter" data-target="member">
                            <button
                                class="btn text-secondary fs-6 border-secondary-subtle dropdown-btn"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                type="button"
                                id="dropdownButton"
                            >
                                <span id="selectedFilter">{{ __('Dari Tahun ke Tahun') }}</span>
                                <i class="bi bi-filter ms-1"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" id="dropdownMenu">
                                <li>
                                    <a class="dropdown-item active" href="#" data-filter="all">
                                        {{ __('Dari Tahun ke Tahun') }}
                                    </a>
                                </li>
                                <li><a class="dropdown-item" href="#" data-filter="today">{{ __('Hari Ini') }}</a></li>
                                <li>
                                    <a class="dropdown-item" href="#" data-filter="month">{{ __('Bulan Ini') }}</a>
                                </li>
                                <li><a class="dropdown-item" href="#" data-filter="year">{{ __('Tahun ini') }}</a></li>
                            </ul>
                        </div>
                    </div>
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

                            const option = {
                                series: [
                                    {
                                        name: '{{ __('Makesta') }}',
                                        data: years.map((year) => makestaCounts[year] || 0),
                                    },
                                    { name: '{{ __('Lakmud') }}', data: years.map((year) => lakmudCounts[year] || 0) },
                                    { name: '{{ __('Lakut') }}', data: years.map((year) => lakutCounts[year] || 0) },
                                ],
                                chart: { height: 350, type: 'area', toolbar: { show: false } },
                                markers: { size: 4 },
                                colors: ['#5CB338', '#ECE852', '#FB4141'],
                                fill: {
                                    type: 'gradient',
                                    gradient: {
                                        shadeIntensity: 1,
                                        opacityFrom: 0.3,
                                        opacityTo: 0.4,
                                        stops: [0, 90, 100],
                                    },
                                },
                                dataLabels: { enabled: false },
                                stroke: { curve: 'smooth', width: 2 },
                                xaxis: { type: 'datetime', categories: years },
                                tooltip: { x: { format: 'yyyy' } },
                                legend: { offsetY: 20, height: 52 },
                            };

                            const memberChart = new ApexCharts(document.querySelector('#reportsChart'), option);

                            memberChart.render();

                            document.querySelectorAll('.dropdown-item').forEach((item) => {
                                item.addEventListener('click', (event) => {
                                    event.preventDefault();

                                    let filterValue = event.target.getAttribute('data-filter');
                                    let dropdown = event.target.closest('.dropdown');
                                    let dropdownButton = dropdown?.querySelector('.dropdown-btn span');
                                    let dropdownMenu = dropdown?.querySelector('.dropdown-menu');

                                    if (!dropdownMenu) return;

                                    if (dropdownButton) {
                                        dropdownButton.textContent = event.target.textContent;
                                    }

                                    dropdown
                                        .querySelectorAll('.dropdown-item')
                                        .forEach((i) => i.classList.remove('active'));
                                    event.target.classList.add('active');

                                    dropdownMenu.classList.remove('show');

                                    let targetType = dropdown.getAttribute('data-target');
                                    if (targetType === 'member') {
                                        filterMember(filterValue);
                                        updateRowNumbers();
                                    } else if (targetType === 'news') {
                                        filterNews(filterValue);
                                        updateRowNumbers();
                                    }
                                });
                            });

                            function filterMember(filter) {
                                const now = new Date();
                                let filteredYears = [];

                                switch (filter) {
                                    case 'today':
                                    case 'month':
                                        filteredYears = [now.getFullYear().toString()];
                                        break;
                                    case 'year':
                                        filteredYears = years.filter((year) => parseInt(year) >= now.getFullYear() - 4);
                                        break;
                                    default:
                                        filteredYears = years;
                                        break;
                                }

                                memberChart.updateOptions({
                                    xaxis: { categories: filteredYears },
                                    series: [
                                        {
                                            name: '{{ __('Makesta') }}',
                                            data: filteredYears.map((year) => makestaCounts[year] || 0),
                                        },
                                        {
                                            name: '{{ __('Lakmud') }}',
                                            data: filteredYears.map((year) => lakmudCounts[year] || 0),
                                        },
                                        {
                                            name: '{{ __('Lakut') }}',
                                            data: filteredYears.map((year) => lakutCounts[year] || 0),
                                        },
                                    ],
                                });
                            }

                            function filterNews(filter) {
                                let rows = document.querySelectorAll('#table tbody tr');

                                rows.forEach((row) => {
                                    let dateText = row.getAttribute('data-updated');
                                    let show = true;

                                    let today = new Date();
                                    let year = today.getFullYear();
                                    let month = String(today.getMonth() + 1).padStart(2, '0');
                                    let day = String(today.getDate()).padStart(2, '0');
                                    let localToday = `${year}-${month}-${day}`;

                                    switch (filter) {
                                        case 'today':
                                            show = dateText === localToday;
                                            break;
                                        case 'month':
                                            let monthOnly = localToday.slice(0, 7);
                                            show = dateText.startsWith(monthOnly);
                                            break;
                                        case 'year':
                                            let yearOnly = localToday.toString().slice(0, 4);
                                            show = dateText.startsWith(yearOnly);
                                            break;
                                        default:
                                            show = true;
                                    }

                                    row.style.display = show ? '' : 'none';
                                });
                            }
                        });
                    </script>
                </div>
            </div>
        </div>

        <!--<div class="col-12">-->
        <!--    <div class="card">-->
        <!--        <div class="card-body p-4">-->
        <!--            <div class="card-header d-flex justify-content-between align-items-center mb-4 border-0 bg-white">-->
        <!--                <h5 class="card-title fw-bold d-flex align-items-baseline fs-4 mb-0">-->
        <!--                    {{ __('Data Transaksi Surat Hari ini') }}-->
        <!--                </h5>-->
        <!--                <div class="dropdown rounded filter" data-target="member">-->
        <!--                    <button-->
        <!--                        class="btn text-secondary fs-6 border-secondary-subtle dropdown-btn"-->
        <!--                        data-bs-toggle="dropdown"-->
        <!--                        aria-expanded="false"-->
        <!--                        type="button"-->
        <!--                        id="dropdownButton"-->
        <!--                    >-->
        <!--                        <span id="selectedFilter">{{ __('Dari Tahun ke Tahun') }}</span>-->
        <!--                        <i class="bi bi-filter ms-1"></i>-->
        <!--                    </button>-->
        <!--                    <ul class="dropdown-menu dropdown-menu-end" id="dropdownMenu">-->
        <!--                        <li>-->
        <!--                            <a class="dropdown-item active" href="#" data-filter="all">-->
        <!--                                {{ __('Dari Tahun ke Tahun') }}-->
        <!--                            </a>-->
        <!--                        </li>-->
        <!--                        <li><a class="dropdown-item" href="#" data-filter="today">{{ __('Hari Ini') }}</a></li>-->
        <!--                        <li>-->
        <!--                            <a class="dropdown-item" href="#" data-filter="month">{{ __('Bulan Ini') }}</a>-->
        <!--                        </li>-->
        <!--                        <li><a class="dropdown-item" href="#" data-filter="year">{{ __('Tahun ini') }}</a></li>-->
        <!--                    </ul>-->
        <!--                </div>-->
        <!--            </div>-->

        <!--            @if ($todayIncomingLetter || $todayOutgoingLetter)-->
        <!--                <div id="letterChart"></div>-->

        <!--                <script>-->
        <!--                    document.addEventListener('DOMContentLoaded', () => {-->
        <!--                        const options = {-->
        <!--                            chart: {-->
        <!--                                height: 350,-->
        <!--                                type: 'bar',-->
        <!--                            },-->
        <!--                            colors: ['#008000FF'],-->
        <!--                            dataLabels: {-->
        <!--                                style: {-->
        <!--                                    fontSize: '20px',-->
        <!--                                    fontWeight: 'bold',-->
        <!--                                },-->
        <!--                            },-->
        <!--                            series: [-->
        <!--                                {-->
        <!--                                    name: '{{ __('Transaksi Surat Hari Ini') }}',-->
        <!--                                    data: [{{ $todayIncomingLetter }}, {{ $todayOutgoingLetter }}],-->
        <!--                                },-->
        <!--                            ],-->

        <!--                            stroke: {-->
        <!--                                curve: 'smooth',-->
        <!--                            },-->
        <!--                            xaxis: {-->
        <!--                                categories: ['{{ __('Surat Masuk') }}', '{{ __('Surat Keluar') }}'],-->
        <!--                            },-->
        <!--                        };-->

        <!--                        const letterChart = new ApexCharts(document.querySelector('#letterChart'), options);-->

        <!--                        letterChart.render();-->
        <!--                    });-->
        <!--                </script>-->
        <!--            @else-->
        <!--                <h5 class="text-secondary text-center">-->
        <!--                    {{ __('Tidak Ada Data Transaksi Surat Hari Ini') }}-->
        <!--                </h5>-->
        <!--            @endif-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->

        <div id="todayGraphic"></div>

        <div class="col-12">
    <div class="card">
        <div class="card-body p-4">
            <div class="card-header d-flex justify-content-between align-items-center mb-4 border-0 bg-white" style="flex-wrap: wrap;">
                <h5 class="card-title fw-bold align-items-baseline fs-4 d-flex mb-0" style="flex: 1 1 auto; min-width: 200px;">
                    {{ __('Data Postingan Berita') }}
                </h5>
                <div class="dropdown rounded filter mt-2 mt-md-0" data-target="news" style="flex-shrink: 0;">
                    <button
                        class="btn text-secondary fs-6 border border-secondary-subtle dropdown-btn"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                        type="button"
                        id="dropdownButton"
                    >
                        <span id="selectedFilter">{{ __('Semua') }}</span>
                        <i class="bi bi-filter ms-1"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" id="dropdownMenu">
                        <li>
                            <a class="dropdown-item active" href="#" data-filter="all">{{ __('Semua') }}</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" data-filter="today">{{ __('Hari Ini') }}</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" data-filter="month">{{ __('Bulan Ini') }}</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" data-filter="year">{{ __('Tahun ini') }}</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Wrapper for scroll on small screens -->
            <div style="width: 100%; overflow-x: auto;">
                <table class="table table-bordered table-hover text-nowrap" id="table" style="min-width: 900px;">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 30px">{{ __('No.') }}</th>
                            <th class="text-start">{{ __('Judul') }}</th>
                            <th class="text-center">{{ __('Kategori') }}</th>
                            <th class="text-center">{{ __('Penulis') }}</th>
                            <th class="text-center">{{ __('Status') }}</th>
                            <th class="text-start">{{ __('Dibuat pada') }}</th>
                            <th class="text-start">{{ __('Diperbarui pada') }}</th>
                            <th class="text-center">{{ __('Aksi') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($news as $post)
                            <tr data-updated="{{ $post->formatted_updated_date }}" data-row>
                                <td class="text-center"></td>
                                <td class="text-start">{{ $post->title }}</td>
                                <td class="text-center">{{ $post->category->title }}</td>
                                <td class="text-center">{{ $post->user->username }}</td>
                                                    <td>
                                                        @if ($post->active == 1)
                                                            <span class="badge bg-success">
                                                                {{ __('Aktif') }}
                                                            </span>
                                                        @else
                                                            <span class="badge bg-danger">
                                                                {{ __('Nonaktif ') }}
                                                            </span>
                                                        @endif
                                                    </td>
                                <td class="text-start">
                                    {{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}
                                </td>
                                <td class="text-start">
                                    {{ \Carbon\Carbon::parse($post->updated_at)->format('d M Y') }}
                                </td>
                                <td class="text-center">
                                    <form
                                        action="{{ route('news.destroy', ['id' => $post->id]) }}"
                                        method="post"
                                        class="float-left"
                                    >
                                        <a
                                            href="{{ route('news.show', ['slug' => $post->slug]) }}"
                                            class="btn btn-success btn-sm"
                                            target="_blank"
                                        >
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a
                                            href="{{ route('news.edit', ['id' => $post->id]) }}"
                                            class="btn btn-warning btn-sm"
                                        >
                                            <i class="bi bi-pen-fill"></i>
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- End scroll wrapper -->
        </div>
    </div>
</div>
    </div>

    <script src="{{ asset('js/statistic.js') }}"></script>

    @include('admins.partials._rightside')
@endsection