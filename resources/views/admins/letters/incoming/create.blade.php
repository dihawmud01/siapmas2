@extends('admins.layout')

@section('title')
    {{ __('Surat Masuk') }}
@endsection

@section('content')
    <x-breadcrumb :values="[__('Surat-menyurat'), __('Surat Masuk'), __('Tambah Surat')]"></x-breadcrumb>

    <div class="card">
        <div class="card-header bg-transparent">
            <div class="d-flex flex-column flex-md-row align-items-center p-3" style="gap: 1rem;">
                <a href="{{ route('dashboard.letters.incoming.index') }}" class="btn fs-4 border-0">
                    <i class="bi bi-chevron-left"></i>
                </a>
                <h3 class="fw-bold m-0 text-center text-md-start" style="flex: 1;">
                    {{ __('Tambah Surat Masuk') }}
                </h3>
            </div>
        </div>

        <div class="card-body">
            <div class="container-fluid px-3">
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-12 col-md-10 col-lg-8">
                        <form
                            action="{{ route('dashboard.letters.incoming.store') }}"
                            method="POST"
                            enctype="multipart/form-data"
                            style="width: 100%;"
                        >
                            @csrf

                            {{-- Input Fields --}}
                            <div class="mb-3">
                                <x-input-form name="name" label="{{ __('Nama Surat') }}" />
                            </div>
                            <div class="mb-3">
                                <x-input-form name="reference_number" label="{{ __('Nomor Surat') }}" />
                            </div>
                            <div class="mb-3">
                                <x-input-form name="from" label="{{ __('Pengirim') }}" required="0" />
                            </div>
                            <div class="mb-3">
                                <x-input-form name="to" label="{{ __('Penerima') }}" required="0" />
                            </div>
                            <div class="mb-3">
                                <x-input-form name="letter_date" label="{{ __('Tanggal Surat') }}" type="date" required="0" />
                            </div>
                            <div class="mb-3">
                                <x-input-form name="received_date" label="{{ __('Tanggal Diterima') }}" type="date" required="0" />
                            </div>
                            <div class="mb-3">
                                <x-input-form name="description" label="{{ __('Perihal') }}" required="0" />
                            </div>
                            <div class="mb-3">
                                <x-input-textarea name="note" label="{{ __('Catatan') }}" />
                            </div>
                            <div class="mb-3">
                                <x-input-select
                                    name="classification_code"
                                    label="{{ __('Kode Klasifikasi') }}"
                                    :options="$classifications"
                                />
                            </div>
                            <div class="mb-3">
                                <x-input-form
                                    name="file"
                                    label="{{ __('File Soft Copy Surat') }}"
                                    type="file"
                                    accept="application/pdf"
                                    required="0"
                                />
                            </div>
                            <div class="mb-4">
                                <x-input-multiple-files
                                    name="attachments"
                                    label="{{ __('Lampiran') }}"
                                    accept="application/pdf"
                                    required="0"
                                />
                            </div>

                            {{-- Tombol --}}
                            <div class="d-flex flex-column flex-md-row justify-content-end align-items-center" style="gap: 1rem;">
                                <a
                                    href="{{ route('dashboard.letters.incoming.index') }}"
                                    class="text-secondary text-decoration-none"
                                    style="font-size: 16px;"
                                >
                                    {{ __('Kembali') }}
                                </a>
                                <button type="submit" class="btn btn-success px-4 py-2">
                                    {{ __('Tambah') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
