<div class="card mb-4 p-4">
    <div class="card-header mb-2 bg-transparent pb-0">
        <div class="d-flex justify-content-between flex-column flex-sm-row">
            <div class="card-title">
                <h5 class="fw-bold mb-1 text-nowrap">{{ __('ID Pengajuan ') . $letter->id }}</h5>
                <small class="text-black">
                    <span class="text-secondary">{{ __('Diajukan oleh:') }}</span>
                    @if ($letter->user->pac_id == 28 || $letter->user->pac_id == 29)
                        {{ $letter->user->pac->pac }}
                    @else
                        {{ __('PAC ') . optional($letter->user->pac)->pac }}
                    @endif
                </small>
            </div>

            <div class="card-title d-flex align-items-center flex-row">
                <div class="d-inline-block mx-2 mb-1 text-end text-black">
                    <small class="d-block text-secondary mb-1">{{ __('Tanggal Pengajuan') }}</small>
                    {{ $letter->formatted_letter_submission_date }}
                </div>
                <div class="ms-3">
                    @if (in_array(auth()->user()->role_id, [3]))
                        <div class="d-flex align-items-center">
                            @php
                                $isIPNU = strtoupper($letter->type ?? '') === 'IPNU';
                                $generateRoute = $isIPNU
                                    ? route('dashboard.letters.validation-submission.generateIPNUSP', $letter)
                                    : route('dashboard.letters.validation-submission.generateIPPNUSP', $letter);
                            @endphp

                            <a
                                href="{{ $letter->status->value == 'approved' ? $generateRoute : '' }}"
                                class="{{ $letter->status->value == 'approved' ? '' : 'disabled-link' }}"
                                target="_blank"
                            >
                                <button
                                    class="btn btn-success btn-lg"
                                    {{ $letter->status->value == 'approved' ? '' : 'disabled' }}
                                >
                                    <i class="bi bi-download"></i>
                                    {{ __('Generate SP') }}
                                </button>
                            </a>

                            @if ($letter->status->value == 'rejected')
                                <a
                                    href="{{ route('dashboard.letters.validation-submission.edit', $letter->id) }}"
                                    class="ms-2"
                                >
                                    <button class="btn btn-warning btn-lg text-white">
                                        <i class="bi bi-pencil-square"></i>
                                        {{ __('Revisi Pengajuan') }}
                                    </button>
                                </a>
                            @endif

                            @if (request()->routeIs('dashboard.letters.validation-submission.index'))
                                <div class="dropdown-center">
                                    <button
                                        class="btn btn-secondary btn-lg dropdown-toggle border-0 bg-transparent pe-0"
                                        type="button"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                    >
                                        <i class="bi bi-three-dots-vertical text-secondary"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a
                                                class="dropdown-item"
                                                href="{{ route('dashboard.letters.validation-submission.show', $letter) }}"
                                            >
                                                {{ __('Lihat Detail') }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                    @else
                        @if (request()->routeIs('dashboard.letters.validation-submission.index'))
                            <a
                                href="{{ route('dashboard.letters.validation-submission.show', $letter) }}"
                                class="btn btn-success btn-lg"
                            >
                                <i class="bi bi-search"></i>
                                {{ __('Review') }}
                            </a>
                        @else
                            <div class="d-flex">
                                <form
                                    method="POST"
                                    action="{{ route('dashboard.letters.validation-submission.approve', $letter) }}"
                                    id="approvalForm"
                                    class="me-2"
                                >
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="letter_number" id="letterNumber" />

                                    <button
                                        class="btn btn-success btn-lg"
                                        type="button"
                                        id="approveBtn"
                                        {{ $letter->status->value == 'approved' ? 'disabled' : '' }}
                                    >
                                        {{ __('Setujui') }}
                                    </button>
                                </form>
                                <form
                                    method="POST"
                                    action="{{ route('dashboard.letters.validation-submission.reject', $letter) }}"
                                    id="rejectionForm"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="rejection_reason" id="rejectionReason" />
                                    <button
                                        class="btn btn-danger btn-lg"
                                        type="button"
                                        id="rejectBtn"
                                        {{ $letter->status->value == 'rejected' ? 'disabled' : '' }}
                                    >
                                        {{ __('Tolak') }}
                                    </button>
                                </form>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    document.getElementById('approveBtn').addEventListener('click', function (event) {
                                        Swal.fire({
                                            title: 'Apakah Anda yakin ingin menyetujui pengajuan ini?',
                                            text: 'Pastikan semua data sudah sesuai sebelum disetujui.',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            cancelButtonText: 'Cek lagi',
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
                                                Swal.fire({
                                                    title: 'Masukkan Nomor Surat',
                                                    input: 'text',
                                                    inputPlaceholder: 'Masukkan nomor surat...',
                                                    inputAttributes: {
                                                        required: true,
                                                    },
                                                    showCancelButton: true,
                                                    confirmButtonText: 'Setujui',
                                                    cancelButtonText: 'Batal',
                                                    reverseButtons: true,
                                                    customClass: {
                                                        cancelButton: 'btn btn-secondary btn-lg',
                                                        confirmButton: 'btn btn-success btn-lg',
                                                        actions: 'swal-custom-actions',
                                                    },
                                                    buttonsStyling: false,
                                                    preConfirm: (letterNumber) => {
                                                        if (!letterNumber) {
                                                            Swal.showValidationMessage('Nomor surat harus diisi!');
                                                        }
                                                        return letterNumber;
                                                    },
                                                }).then((inputResult) => {
                                                    if (inputResult.isConfirmed) {
                                                        document.getElementById('letterNumber').value =
                                                            inputResult.value;
                                                        document.getElementById('approvalForm').submit();
                                                    }
                                                });
                                            }
                                        });
                                    });
                                    document.getElementById('rejectBtn').addEventListener('click', function (event) {
                                        Swal.fire({
                                            title: 'Alasan Penolakan',
                                            text: 'Silakan masukkan alasan mengapa pengajuan SP ini ditolak.',
                                            input: 'textarea',
                                            inputPlaceholder: 'Masukkan alasan penolakan di sini...',
                                            inputAttributes: {
                                                'aria-label': 'Masukkan alasan penolakan di sini',
                                                required: true,
                                            },
                                            icon: 'warning',
                                            showCancelButton: true,
                                            cancelButtonText: 'Batal',
                                            confirmButtonText: 'Tolak Pengajuan',
                                            reverseButtons: true,
                                            customClass: {
                                                cancelButton: 'btn btn-secondary btn-lg',
                                                confirmButton: 'btn btn-danger btn-lg',
                                                actions: 'swal-custom-actions',
                                            },
                                            buttonsStyling: false,
                                            preConfirm: (reason) => {
                                                if (!reason || reason.trim() === '') {
                                                    Swal.showValidationMessage('Alasan penolakan wajib diisi!');
                                                }
                                                return reason;
                                            },
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                document.getElementById('rejectionReason').value = result.value;
                                                document.getElementById('rejectionForm').submit();
                                            }
                                        });
                                    });
                                });
                            </script>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <p class="fs-5 mb-3">
                <strong>{{ __('Status: ') }}</strong>

                @if ($letter->status->value == 'pending')
                    <span class="badge bg-warning text-dark fs-6 fw-normal ms-2 p-2">
                        {{ $letter->status->label() }}
                    </span>
                @elseif ($letter->status->value == 'approved')
                    <span class="badge bg-success text-light fs-6 fw-normal ms-2 p-2">
                        {{ $letter->status->label() }}
                    </span>
                @elseif ($letter->status->value == 'rejected')
                    <span class="badge bg-danger text-light fs-6 fw-normal ms-2 p-2">
                        {{ $letter->status->label() }}
                    </span>
                @endif
            </p>

            {{-- Organization Level Display --}}
            @if ($letter->organization_level)
                <p class="fs-5 mb-3">
                    <strong>{{ __('Tingkat Organisasi: ') }}</strong>
                    <span class="badge bg-primary text-light fs-6 fw-normal ms-2 p-2">
                        {{ $letter->organization_level->label() }}
                    </span>
                    @if ($letter->sub_organization_name)
                        <span class="text-dark ms-2">({{ $letter->sub_organization_name }})</span>
                    @endif
                </p>
            @endif
        </div>

        @if (in_array(auth()->user()->role_id, [3]))
            <p class="fs-5">
                <strong>{{ __('Keterangan: ') }}</strong>
                @if ($letter->status->value == 'pending')
                    {{ __('Belum dapat melakukan generate SP karena belum disetujui oleh PC') }}
                @elseif ($letter->status->value == 'approved')
                    {{ __('Pengajuan SP sudah disetujui oleh PC. SP sudah dapat digenerate') }}
                @elseif ($letter->status->value == 'rejected')
                    <span class="d-block mb-1">
                        {{ __('Mohon maaf pengajuan SP anda ditolak oleh PC dengan alasan:') }}
                    </span>
                    <div class="alert alert-danger mb-0 mt-2 p-3">
                        {{ $letter->rejection_reason ?? 'Tidak ada alasan spesifik yang diberikan.' }}
                    </div>
                @endif
            </p>
        @endif

        <div class="d-flex justify-content-between flex-column flex-sm-row">
            <small class="text-secondary">
                {{ __('Disetujui pada: ') }}
                {{ $letter->status->value == 'pending' || $letter->status->value == 'rejected' ? '-' : $letter->formatted_approved_date }}
            </small>
        </div>

        {{ $slot }}
    </div>
</div>
