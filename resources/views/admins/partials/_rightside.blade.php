@push('script')
    @vite(['resources/js/plugins/echarts.js'])
@endpush

<div class="card">
    <div class="card-body p-5">
        <h5 class="card-title fw-bold fs-4 mb-4">
            {{ __('Kader Berdasarkan Jenis Kelamin') }}
        </h5>

        <div id="trafficChart" style="min-height: 400px" class="echart"></div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                echarts.init(document.querySelector('#trafficChart')).setOption({
                    tooltip: {
                        trigger: 'item',
                    },
                    legend: {
                        bottom: '0',
                        left: 'center',
                        orient: 'horizontal',
                    },
                    series: [
                        {
                            name: '{{ __('Jenis Kelamin') }}',
                            type: 'pie',
                            radius: ['40%', '70%'],
                            avoidLabelOverlap: false,
                            label: {
                                show: false,
                                position: 'center',
                            },
                            emphasis: {
                                label: {
                                    show: true,
                                    fontSize: '18',
                                    fontWeight: 'bold',
                                },
                            },
                            labelLine: {
                                show: false,
                            },
                            data: [
                                {
                                    value: {{ $genderCounts['female'] }},
                                    name: '{{ __('Kader Perempuan') }}',
                                },
                                {
                                    value: {{ $genderCounts['male'] }},
                                    name: '{{ __('Kader Laki-Laki') }}',
                                },
                            ],
                        },
                    ],
                });
            });
        </script>
    </div>
</div>

<div class="col-12 col-xl-8 offset-xl-2 col-lg-10 offset-lg-1 p-4" data-aos="fade-up">
    <div class="card rounded-4 border-0 shadow-sm">
        <div class="card-body p-md-5 p-4">
            <div class="mb-4 text-center">
                <h4 class="fw-bold text-success mb-1">
                    <i class="bi bi-diagram-3-fill me-2"></i>
                    {{ __('Kader Berdasarkan PAC/Komisariat') }}
                </h4>
                <p class="text-muted small mb-0">
                    {{ __('Distribusi penyebaran kader di setiap Pimpinan Anak Cabang atau Komisariat') }}
                </p>
            </div>

            {{-- Tabel Kader --}}
            <div class="table-responsive">
                <table
                    class="table-hover mb-0 table text-center align-middle"
                    id="kaderTable"
                    style="border-collapse: separate; border-spacing: 0 0.5rem"
                >
                    <thead style="background-color: rgba(92, 179, 56, 0.1)">
                        <tr class="text-success">
                            <th scope="col" class="rounded-start border-0 py-3" style="width: 10%">#</th>
                            <th scope="col" class="border-0 py-3 text-start" style="width: 60%">PAC/Komisariat</th>
                            <th scope="col" class="rounded-end border-0 py-3" style="width: 30%">Jumlah Kader</th>
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
                            usort($dataList, fn ($a, $b) => strcmp($a['nama'], $b['nama']));
                        @endphp

                        @foreach ($dataList as $i => $item)
                            <tr class="bg-white shadow-sm">
                                <td class="rounded-start text-muted fw-bold border-0 py-3">{{ $i + 1 }}</td>
                                <td class="fw-semibold text-dark border-0 py-3 text-start">{{ $item['nama'] }}</td>
                                <td class="rounded-end border-0 py-3">
                                    <span
                                        class="badge bg-success text-success rounded-pill fw-bold bg-opacity-10 px-3 py-2"
                                    >
                                        {{ $item['jumlah'] }} Kader
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
