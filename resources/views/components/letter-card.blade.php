<div class="card mb-4 p-4">
    <div class="card-header mb-2 bg-transparent pb-0">
        <div class="d-flex justify-content-between flex-column flex-sm-row">
            <div class="card-title">
                <h5 class="fw-bold mb-1 text-nowrap">{{ $letter->reference_number }}</h5>
                <small class="text-secondary">
                    {{ $letter->from . ' | ' . $letter->classification->type }}
                </small>
            </div>

            <div class="card-title d-flex align-items-center flex-row">
                <div class="d-inline-block mx-2 mb-1 text-end text-black">
                    <small class="d-block text-secondary mb-1">{{ __('Tanggal Surat') }}</small>
                    <p>{{ $letter->formatted_letter_date }}</p>
                </div>
                <div class="dropdown-center">
                    <button
                        class="btn btn-secondary btn-lg dropdown-toggle border-0 bg-transparent pe-0"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        <i class="bi bi-three-dots-vertical text-secondary"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdown-{{ $letter->type }}-{{ $letter->id }}">
                        <a class="dropdown-item" href="{{ route('dashboard.letters.incoming.edit', $letter) }}">
                            {{ __('Edit') }}
                        </a>
                        <form action="{{ route('dashboard.letters.incoming.destroy', $letter) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="dropdown-item btn btn-sm btn-delete cursor-pointer text-start" type="button">
                                {{ __('Hapus') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <div class="mb-3">
                <p>
                    {{ $letter->description }}
                </p>
                <p class="text-secondary">
                    {{ $letter->note }}
                </p>
            </div>
        </div>
        {{ $slot }}
    </div>
</div>

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