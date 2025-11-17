@section('title')
    {{ __('Hari Besar') }}
@endsection

@extends('admins.layout')

@section('content')
    <div class="card info-card sales-card">
        <div class="container my-3">
            <h4 class="my-5 text-center">{{ __('Hari Besar Nasional') }}</h4>

            <a class="btn btn-primary mx-3 mb-3" href="{{ route('hbn.create') }}">{{ __('Tambah') }}</a>

            <table class="table-striped table-hover table">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('No') }}</th>
                        <th class="text-center">{{ __('Nama') }}</th>
                        <th class="text-start">{{ __('Tanggal') }}</th>
                        <th class="text-center">{{ __('Waktu') }}</th>
                        <th class="text-center">{{ __('Aksi') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hbns as $day => $national_day)
                        <tr>
                            <td class="text-center">{{ $day + $hbns->firstItem() }}</td>
                            <td>{{ $national_day->title }}</td>
                            <td>{{ date('Y-m-d', strtotime($national_day->date)) }}</td>
                            <td class="text-center">
                                <div id="countdown-{{ $loop->iteration }}"></div>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('hbn.destroy', $national_day->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('{{ __('Apakah Anda yakin ingin menghapus data ini?') }}')"
                                    >
                                        {{ __('Hapus') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $hbns->links() }}
            </div>
        </div>
    </div>

    @foreach ($hbns as $national_day)
        <script>
            var targetDate{{ $loop->iteration }} = new Date('{{ date('Y-m-d', strtotime($national_day->date)) }}');

            function countdownTimer{{ $loop->iteration }}() {
                var now = new Date();
                var distance = targetDate{{ $loop->iteration }} - now;

                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var countdownDiv = document.getElementById('countdown-{{ $loop->iteration }}');
                countdownDiv.innerHTML = '';

                if (days > 0) {
                    var countdownText = `{{ __('Tinggal') }} ${days} {{ __('hari lagi') }}`;
                    countdownDiv.innerHTML = `<p>${countdownText}</p>`;
                } else {
                    countdownDiv.innerHTML = `<p>{{ __('Tanggal telah berlalu') }}</p>`;
                }

                setTimeout(countdownTimer{{ $loop->iteration }}, 1000);
            }

            countdownTimer{{ $loop->iteration }}();
        </script>
    @endforeach

    <div
        class="modal fade"
        id="staticBackdrop"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ __('Hari Besar Nasional') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Tutup') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
