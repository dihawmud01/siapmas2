@section('title')
    {{ __('Agenda') }}
@endsection

@extends('users.layout')

@push('style')
    @vite('resources/css/calendar.css')
    
@endpush

@push('script')
    @vite('resources/js/plugins/fullcalendar.js')
@endpush

@section('content')
    <div class="container my-5 pt-3 text-center" data-aos="fade-up">
        <h1 class="fw-semibold pt-5" id="desktop-view">{{ __('Kalender Kegiatan') }}</h1>
        <div class="container-content mb-4 py-1 pb-2" data-aos="fade-up">
            <a href="{{ route('calendar.full') }}" id="cal_mobile">
                <img src="{{ asset('storage/images/calendar_img.png') }}" alt="{{ __('Kalendar') }}">
                <span class="button-overlay">{{ __('Lihat Kalender') }}</span>
            </a>
            <div id="calendar" class="rounded shadow"></div>
        </div>
    </div>

    <div class="container my-1">
        <div class="row">
            <div class="container my-5 pt-3 text-center" data-aos="fade-up">
                <h1 class="fw-semibold pt-5">{{ __('Agenda Kegiatan') }}</h1>
            </div>
            <div class="container mb-4 pb-4 pt-2" data-aos="fade-up">
                <div class="card info-card sales-card rounded-2 border-0 p-4">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr class="fs-5">
                                    <th class="p-4 text-center">{{ __('No.') }}</th>
                                    <th class="p-4 text-start">{{ __('Nama Kegiatan') }}</th>
                                    <th class="p-4 text-start">{{ __('Penyelenggara') }}</th>
                                    <th class="p-4 text-start">{{ __('Waktu') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events->take(20) as $event)
                                    <tr>
                                        <td class="p-4 text-center" data-label="{{ __('No.') }}">{{ $loop->iteration }}</td>
                                        <td class="p-4 text-start" data-label="{{ __('Nama Kegiatan') }}">{{ $event->title }}</td>
                                        <td class="p-4 text-start" data-label="{{ __('Penyelenggara') }}">{{ $event->organizer }}</td>
                                        <td class="p-4 text-start" data-label="{{ __('Waktu') }}">{{ $event->formatted_date }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="container my-5 pt-3 text-center" data-aos="fade-up">
                <h1 class="fw-semibold pt-5">{{ __('Hari Besar Nasional') }}</h1>
            </div>
            <div class="container mb-4 pb-4 pt-2" data-aos="fade-up">
                <div class="card info-card sales-card rounded-2 border-0 p-4">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr class="fs-5">
                                    <th class="p-4 text-center">{{ __('No.') }}</th>
                                    <th class="p-4 text-start">{{ __('Hari Besar') }}</th>
                                    <th class="p-4 text-start">{{ __('Tanggal') }}</th>
                                    <th class="p-4 text-start">{{ __('Waktu') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hbn as $day => $idx)
                                    <tr>
                                        <td class="p-4 text-center" data-label="{{ __('No.') }}">{{ $loop->iteration }}</td>
                                        <td class="p-4 text-start" data-label="{{ __('Hari Besar') }}">{{ $idx->title }}</td>
                                        <td class="p-4 text-start" data-label="{{ __('Tanggal') }}">{{ $idx->formatted_date }}</td>
                                        <td class="p-4 text-start" data-label="{{ __('Waktu') }}">
                                            <div id="countdown-{{ $loop->iteration }}"></div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-4" id="staticBackdropLabel">{{ __('Agenda Kegiatan') }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-5">
                            <div class="row text-start">
                                <div class="col-md-4 mb-3">
                                    <img id="pamphlet" src="" alt="{{ __('Pamflet') }}" class="img-fluid rounded" />
                                    <div class="mt-3 text-center">
                                        <p id="status"></p>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="fw-bold">{{ __('Nama Kegiatan') }}</h5>
                                            <p id="title"></p>
                                            <h5 class="fw-bold">{{ __('Penyelenggara Kegiatan') }}</h5>
                                            <p id="organizer"></p>
                                            <h5 class="fw-bold">{{ __('Hari/tanggal') }}</h5>
                                            <p id="date"></p>
                                            <h5 class="fw-bold">{{ __('Pukul') }}</h5>
                                            <p id="time"></p>
                                            <h5 class="fw-bold">{{ __('Tempat') }}</h5>
                                            <p id="place"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="fw-bold">{{ __('Kategori') }}</h5>
                                            <p id="category"></p>
                                            <h5 class="fw-bold">{{ __('Jumlah Peserta') }}</h5>
                                            <p id="totalParticipants"></p>
                                            <h5 class="fw-bold">{{ __('Target Capaian') }}</h5>
                                            <p id="target"></p>
                                            <h5 class="fw-bold">{{ __('Evaluasi Kegiatan') }}</h5>
                                            <p id="evaluation" class="mb-0"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @foreach ($hbn as $day)
                <script>
                    let targetDate{{ $loop->iteration }} = new Date('{{ date('Y-m-d', strtotime($day->date)) }}');

                    function countdownTimer{{ $loop->iteration }}() {
                        let now = new Date();
                        let distance = targetDate{{ $loop->iteration }} - now;

                        let days = Math.floor(distance / (1000 * 60 * 60 * 24));

                        let countdownDiv = document.getElementById('countdown-{{ $loop->iteration }}');
                        countdownDiv.innerHTML = '';

                        if (days > 0) {
                            let countdownText = '{{ __('Tinggal') }} ' + days + ' {{ __('hari lagi') }}';
                            countdownDiv.innerHTML = '<p class="fw-normal">' + countdownText + '</p>';
                        } else {
                            countdownDiv.innerHTML = '<p class="text-secondary">{{ __('Tanggal telah berlalu') }}</p>';
                        }

                        setTimeout(countdownTimer{{ $loop->iteration }}, 1000);
                    }

                    countdownTimer{{ $loop->iteration }}();
                </script>
            @endforeach
        </div>
    </div>
@endsection