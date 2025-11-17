@section('title')
    {{ __('Surat Masuk') }}
@endsection

@extends('admins.layout')

@section('content')
    <x-breadcrumb :values="[__('Surat-menyurat'), __('Surat Masuk'), __('Edit Surat')]"></x-breadcrumb>

    <div class="card">
        <div class="card-header bg-transparent text-center">
            <div class="d-flex align-items-center p-4">
                <div class="text-start">
                    <a href="{{ route('dashboard.letters.incoming.index') }}" class="btn fs-4 border-0">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                </div>
                <div class="d-flex flex-column w-100">
                    <h3 class="fw-bold">{{ __('Edit Surat Masuk') }}</h3>
                </div>
            </div>
        </div>

        <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <div class="row mt-5 pt-4">
                <form
                    action="{{ route('dashboard.letters.incoming.update', $incoming) }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf
                    @method('PUT')

                    <x-input-form name="name" label="{{ __('Nama Surat') }}" :value="$incoming->name" />
                    <x-input-form
                        name="reference_number"
                        label="{{ __('Nomor Surat') }}"
                        :value="$incoming->reference_number"
                    />
                    <x-input-form name="from" label="{{ __('Pengirim') }}" :value="$incoming->from" required="0" />
                    <x-input-form name="to" label="{{ __('Penerima') }}" :value="$incoming->to" required="0" />
                    <x-input-form
                        name="letter_date"
                        label="{{ __('Tanggal Surat') }}"
                        type="date"
                        :value="$incoming->letter_date?->format('Y-m-d')"
                        required="0"
                    />
                    <x-input-form
                        name="received_date"
                        label="{{ __('Tanggal Diterima') }}"
                        type="date"
                        :value="$incoming->received_date?->format('Y-m-d')"
                        required="0"
                    />
                    <x-input-form
                        name="description"
                        label="{{ __('Perihal') }}"
                        :value="$incoming->description"
                        required="0"
                    />

                    <x-input-textarea name="note" label="{{ __('Catatan') }}" :value="$incoming->note" />

                    <x-input-select
                        name="classification_code"
                        label="{{ __('Kode Klasifikasi') }}"
                        :options="$classifications"
                        :selected="$incoming->classification_code"
                    />

                    <div class="d-flex gap-2">
                        <x-input-form
                            name="file"
                            label="{{ __('File Soft Copy Surat') }}"
                            type="file"
                            accept="application/pdf"
                            required="0"
                        />

                        @if ($incoming->file != null)
                            <div class="d-flex gap-2">
                                <div class="d-flex align-items-start">
                                    <a
                                        href="{{ asset("storage/documents/letters/incoming/{$pacSlug}/soft-copies/{$incoming->reference_number}/{$incoming->file}") }}"
                                        target="_blank"
                                        class="text-decoration-none text-success"
                                        id="file-link"
                                    >
                                        {{ Str::limit($incoming->name . '.pdf', 30) }}
                                    </a>

                                    <button
                                        type="button"
                                        class="btn ms-2 p-0"
                                        id="remove-file-btn"
                                        title="{{ __('Hapus File') }}"
                                    >
                                        <i class="bi bi-x"></i>
                                    </button>

                                    <button
                                        type="button"
                                        class="btn text-success ms-2 p-0"
                                        id="cancel-remove-btn"
                                        title="{{ __('Batal Hapus') }}"
                                        style="display: none"
                                    >
                                        {{ __('Batal Hapus') }}
                                    </button>
                                </div>

                                <input type="hidden" name="delete_file" value="0" id="delete-file-flag" />
                            </div>
                        @endif
                    </div>

                    <x-input-multiple-files
                        name="attachments"
                        label="{{ __('Tambahkan Lampiran Baru') }}"
                        accept="application/pdf"
                        required="0"
                    />

                    <div class="d-flex align-items-center justify-content-end">
                        <a
                            href="{{ route('dashboard.letters.incoming.index') }}"
                            class="text-secondary text-decoration-none me-3"
                        >
                            {{ __('Kembali') }}
                        </a>
                        <button type="submit" class="btn btn-success">
                            {{ __('Perbarui') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection