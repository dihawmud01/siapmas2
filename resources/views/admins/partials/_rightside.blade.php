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
