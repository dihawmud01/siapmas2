@section('title')
    {{ __('Surat keluar') }}
@endsection

@extends('admins.layout')

@section('content')
    <x-breadcrumb :values="[__('Surat-menyurat'), __('Surat keluar'), __('Tambah Surat')]"></x-breadcrumb>

    <div class="card">
        <div class="card-header bg-transparent text-center">
            <div class="d-flex align-items-center p-4">
                <div class="text-start">
                    <a href="{{ route('dashboard.letters.outgoing.index') }}" class="btn fs-4 border-0">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                </div>
                <div class="d-flex flex-column w-100">
                    <h3 class="fw-bold">{{ __('Tambah Surat keluar') }}</h3>
                </div>
            </div>
        </div>

        <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <div class="row mt-5 pt-4">
                <form
                    action="{{ route('dashboard.letters.outgoing.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf

                    <x-input-form name="name" label="{{ __('Nama Surat') }}" />
                    <x-input-form name="reference_number" label="{{ __('Nomor Surat') }}" />
                    <x-input-form name="from" label="{{ __('Pengirim') }}" required="0" />
                    <x-input-form name="to" label="{{ __('Penerima') }}" required="0" />
                    <x-input-form name="letter_date" label="{{ __('Tanggal Surat') }}" type="date" required="0" />
                    <x-input-form name="received_date" label="{{ __('Tanggal Diterima') }}" type="date" required="0" />
                    <x-input-form name="description" label="{{ __('Perihal') }}" required="0" />
                    <x-input-textarea name="note" label="{{ __('Catatan') }}" />

                    <x-input-select
                        name="classification_code"
                        label="{{ __('Kode Klasifikasi') }}"
                        :options="$classifications"
                    />

                    <x-input-form
                        name="file"
                        label="{{ __('File Soft Copy Surat') }}"
                        type="file"
                        accept="application/pdf"
                        required="0"
                    />

                    <x-input-multiple-files
                        name="attachments"
                        label="{{ __('Lampiran') }}"
                        accept="application/pdf"
                        required="0"
                    />

                    <div class="d-flex align-items-center justify-content-end">
                        <a
                            href="{{ route('dashboard.letters.outgoing.index') }}"
                            class="text-secondary text-decoration-none me-3"
                        >
                            {{ __('Kembali') }}
                        </a>
                        <button type="submit" class="btn btn-success">
                            {{ __('Tambah') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection