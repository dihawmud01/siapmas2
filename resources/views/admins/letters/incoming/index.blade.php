@section('title')
    {{ __('Surat Masuk') }}
@endsection

@extends('admins.layout')

@section('content')
    <x-breadcrumb :values="[__('Surat-menyurat'), __('Surat Masuk')]"></x-breadcrumb>
    <div class="card info-card sales-card min-vh-100">
        <div class="card-header bg-transparent text-center">
            <div class="d-flex align-items-center p-4">
                <div class="d-flex flex-column w-100">
                    <h3 class="fw-bold">
                        {{ __('Data Surat Masuk') }}
                        @if (auth()->user()->role_id == 3)
                            {{ in_array(auth()->user()->pac_id, [28, 29]) ? ' ' . str_replace(['Uin', 'Unu'], ['UIN', 'UNU'], ucwords(strtolower(auth()->user()->pac->pac))) : ' PAC ' . ucwords(strtolower(auth()->user()->pac->pac)) }}
                        @endif
                    </h3>
                </div>
            </div>
        </div>

        <div class="container-fluid p-5">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h5 class="fw-semibold mb-0">{{ __('Total Surat Masuk: ') }} {{ $totalIncoming }}</h5>
                <div class="d-flex justify-content-between align-items-end mb-3 flex-wrap gap-3">
                    <form action="{{ url()->current() }}" method="GET" class="d-flex align-items-end flex-wrap gap-2">
                        <x-input-filter
                            name="since"
                            label="{{ __('Dari Tanggal') }}"
                            type="date"
                            :value="$since ? date('Y-m-d', strtotime($since)) : ''"
                        />

                        <x-input-filter
                            name="until"
                            label="{{ __('Sampai Tanggal') }}"
                            type="date"
                            :value="$until ? date('Y-m-d', strtotime($until)) : ''"
                        />

                        <div class="mb-3">
                            <label for="filter" class="form-label">{{ __('Filter Berdasarkan') }}</label>
                            <select class="form-select" id="filter" name="filter">
                                <option value="letter_date" @selected(old('filter', $filter) == 'letter_date')>
                                    {{ __('Tanggal Surat') }}
                                </option>
                                <option value="received_date" @selected(old('filter', $filter) == 'received_date')>
                                    {{ __('Tanggal Diterima') }}
                                </option>
                                <option value="created_at" @selected(old('filter', $filter) == 'created_at')>
                                    {{ __('Tanggal Dibuat') }}
                                </option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <button class="btn btn-success" type="submit">
                                <i class="bi bi-filter"></i>
                                {{ __('Saring') }}
                            </button>

                            <a
                                href="{{ route('dashboard.letters.incoming.print') . '?' . $query }}"
                                target="_blank"
                                class="btn btn-success text-light text-decoration-none"
                            >
                                <i class="bi bi-printer-fill"></i>
                                {{ __('Cetak') }}
                            </a>
                        </div>
                    </form>
                    <a
                        href="{{ route('dashboard.letters.incoming.create') }}"
                        class="btn btn-success text-light d-flex align-items-center mb-3"
                    >
                        <i class="bi bi-envelope-plus-fill me-1"></i>
                        {{ __('Tambah') }}
                    </a>
                </div>
            </div>

            @if ($incoming->isEmpty())
    <div class="d-flex align-items-center justify-content-center empty-content p-4">
        <div class="text-center">
            <h1 class="text-secondary mb-3">{{ __('Belum ada surat masuk') }}</h1>
        </div>
    </div>
@else
    <div class="table-responsive">
        <table class="table table-bordered align-middle" id="table">
            <thead class="table-light text-center">
                <tr class="fw-bold">
                    <th>{{ __('No.') }}</th>
                    <th class="text-start">{{ __('Nama Surat') }}</th>
                    <th>{{ __('No. Surat') }}</th>
                    <th class="text-start">{{ __('Pengirim') }}</th>
                    <th class="text-start">{{ __('Tanggal') }}</th>
                    <th>{{ __('Aksi') }}</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($incoming as $idx => $letter)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $letter->name }}</td>
                        <td class="text-center">
                            <a
                                href="{{ route('dashboard.letters.incoming.show', $letter) }}"
                                class="text-decoration-none text-success fw-semibold"
                            >
                                {{ $letter->reference_number }}
                            </a>
                        </td>
                        <td>{{ $letter->from }}</td>
                        <td>{{ $letter->formatted_letter_date }}</td>
                        <td class="text-center">
                            <a
                                href="{{ route('dashboard.letters.incoming.show', $letter) }}"
                                class="btn btn-success btn-sm me-1"
                                title="Lihat"
                            >
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            <a
                                href="{{ route('dashboard.letters.incoming.edit', $letter) }}"
                                class="btn btn-warning btn-sm me-1"
                                title="Edit"
                            >
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <form
                                action="{{ route('dashboard.letters.incoming.destroy', $letter) }}"
                                method="POST"
                                class="d-inline"
                            >
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm btn-delete" title="Hapus">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $incoming->links() }}
    </div>
@endif


    <script>
        document.querySelectorAll('.btn-delete').forEach((btn, idx) => {
            btn.addEventListener('click', function (event) {
                Swal.fire({
                    title: 'Apakah Anda yakin ingin menghapus surat ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Ya',
                    reverseButtons: true,
                    customClass: {
                        cancelButton: 'btn btn-secondary btn-lg',
                        confirmButton: 'btn btn-success btn-lg',
                        actions: 'swal-custom-actions',
                    },
                    buttonsStyling: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let form = btn.closest('form');
                        if (form) {
                            form.submit();
                        } else {
                            console.error('Form tidak ditemukan!');
                        }
                    }
                });
            });
        });
    </script>
@endsection