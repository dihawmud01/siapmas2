@section('title')
    {{ __('Surat Keluar') }}
@endsection

@extends('admins.layout')


@section('content')
    @section('content')
        <x-breadcrumb :values="[__('Surat-menyurat'), __('Surat Keluar'), __('Detail Surat')]"></x-breadcrumb>

        <x-letter-card :letter="$outgoing">
            <div class="mt-2">
                <div class="divider mt-0">
                    <div class="divider-text fs-6 text-secondary">{{ __('Detail Surat') }}</div>
                </div>
                <dl class="row mt-3">
                    <dt class="col-sm-3">{{ __('Tanggal Surat') }}</dt>
                    <dd class="col-sm-9">{{ $outgoing->formatted_letter_date }}</dd>

                    <dt class="col-sm-3">{{ __('Tanggal Diterima') }}</dt>
                    <dd class="col-sm-9">{{ $outgoing->formatted_received_date }}</dd>

                    <dt class="col-sm-3">{{ __('Nomor Surat') }}</dt>
                    <dd class="col-sm-9">{{ $outgoing->reference_number }}</dd>

                    <dt class="col-sm-3">{{ __('Kode') }}</dt>
                    <dd class="col-sm-9">{{ $outgoing->classification_code }}</dd>

                    <dt class="col-sm-3">{{ __('Klasifikasi') }}</dt>
                    <dd class="col-sm-9">{{ $outgoing->classification?->type }}</dd>

                    <dt class="col-sm-3">{{ __('Pengirim') }}</dt>
                    <dd class="col-sm-9">{{ $outgoing->from }}</dd>

                    <dt class="col-sm-3">{{ __('Penerima') }}</dt>
                    <dd class="col-sm-9">{{ $outgoing->to }}</dd>

                    <dt class="col-sm-3">{{ __('Dibuat oleh') }}</dt>
                    <dd class="col-sm-9">{{ $outgoing->user?->name }}</dd>

                    <dt class="col-sm-3">{{ __('Dibuat pada') }}</dt>
                    <dd class="col-sm-9">{{ $outgoing->formatted_created_at }}</dd>

                    <dt class="col-sm-3">{{ __('Diprebarui pada') }}</dt>
                    <dd class="col-sm-9">{{ $outgoing->formatted_updated_at }}</dd>

                    <dt class="col-sm-3">{{ __('File') }}</dt>
                    <dd class="col-sm-9">
                        @if ($outgoing->file != null)
                            <div class="pdf-preview rounded border">
                                <a
                                    href="{{ asset("storage/documents/letters/outgoing/{$pacSlug}/soft-copies/{$outgoing->id}/{$outgoing->file}") }}"
                                    target="_blank"
                                    class="text-decoration-none"
                                >
                                    <div class="pdf-thumbnail">
                                        <img
                                            src="{{ asset("storage/images/thumbnails/letters/outgoing/{$pacSlug}/soft-copies/{$outgoing->id}/" . pathinfo($outgoing->file, PATHINFO_FILENAME) . '.jpg') }}"
                                            alt="PDF Thumbnail"
                                        />
                                    </div>
                                    <div class="pdf-meta fs-6">
                                        <i class="bi bi-file-earmark-pdf-fill text-danger"></i>
                                        <span class="filename">
                                            {{ \Illuminate\Support\Str::limit($outgoing->name . '.pdf', 30) }}
                                        </span>
                                    </div>
                                </a>
                            </div>
                        @else
                            -
                        @endif
                    </dd>
                </dl>

                @if (! $outgoing->attachments->isEmpty())
                    <div class="divider mt-0">
                        <div class="divider-text fs-6 text-secondary">{{ __('Lampiran-lampiran') }}</div>
                    </div>
                    <dd class="col-sm-9">
                        <div class="d-flex flex-wrap gap-3">
                            @foreach ($outgoing->attachments as $attachment)
                                <div class="pdf-preview rounded border">
                                    <a
                                        href="{{ asset("storage/documents/letters/outgoing/{$pacSlug}/attachments/{$outgoing->id}/{$attachment->file}") }}"
                                        target="_blank"
                                        class="text-decoration-none"
                                    >
                                        <div class="pdf-thumbnail">
                                            <img
                                                src="{{ asset("storage/images/thumbnails/letters/outgoing/{$pacSlug}/attachments/{$outgoing->id}/" . pathinfo($attachment->file, PATHINFO_FILENAME) . '.jpg') }}"
                                                alt="Attachment Thumbnail"
                                            />
                                        </div>
                                        <div class="pdf-meta fs-6">
                                            <i class="bi bi-file-earmark-pdf-fill text-danger"></i>
                                            <span class="filename">
                                                {{ \Illuminate\Support\Str::limit('Lampiran ' . $loop->iteration . '.pdf', 30) }}
                                            </span>
                                        </div>
                                    </a>
                                    <form
                                        action="{{ route('dashboard.letters.outgoing.attachments.destroy', $attachment) }}"
                                        method="POST"
                                        class="d-inline"
                                        id="delete-form"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="button"
                                            class="btn btn-lg position-absolute btn-delete btn-delete-attachment end-0 top-0 border-0"
                                            title="Hapus File"
                                        >
                                            <i class="bi bi-x-circle-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </dd>
                    <script>
                        document.querySelectorAll('.btn-delete').forEach((btn, idx) => {
                            btn.addEventListener('click', function (event) {
                                Swal.fire({
                                    title: 'Apakah Anda yakin ingin menghapus lampiran ini?',
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
                @endif
            </div>
        </x-letter-card>
    @endsection
@endsection