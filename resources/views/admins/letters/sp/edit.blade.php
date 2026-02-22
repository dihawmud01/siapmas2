@section('title')
    {{ __('Surat Pengesahan (SP)') }}
@endsection

@extends('admins.layout')

@push('script')
    @vite('resources/js/plugins/alpine.js')
@endpush

@php
    $adminPcPhone = '6287722731714'; // Nomor WA admin PC (tanpa +)
    $user = auth()->user();
    $pacName = $user && $user->pac ? $user->pac->pac : 'PAC Tidak Diketahui';
@endphp

@section('content')
    <x-breadcrumb
        :values="[
            __('Surat-menyurat'),
            __('Pengajuan Surat Pengesahan (SP)'),
            __('Revisi Pengajuan'),
            strtoupper($letter->type),
        ]"
    ></x-breadcrumb>

    <div class="card">
        <div class="card-header bg-transparent">
            <div class="d-flex align-items-center p-4">
                <div class="d-flex flex-column w-100">
                    <h3 class="fw-bold">
                        {{ __('Form Revisi Surat Pengesahan PAC/PR/PK') }} -
                        {{ strtoupper($letter->type) }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="card-body p-4">
            <form
                method="POST"
                action="{{ route('dashboard.letters.validation-submission.update', $letter->id) }}"
                enctype="multipart/form-data"
                x-data="{
                    step: 1,
                    orgLevel: '{{ $letter->organization_level->value }}',
                    errors: {},
                    waPhone: '{{ $adminPcPhone }}',
                    pacName: '{{ $pacName }}',
                    validateStep1() {
                        this.errors = {}

                        let fields = [
                            'type',
                            'organization_level',
                            'event_date',
                            'event_location',
                            'pelantikan_date',
                            'mwc_letter_number',
                            'mwc_letter_date',
                        ]

                        // Validate sub_organization_name if PR or PK
                        if (this.orgLevel !== 'PAC') {
                            let subOrgInput = document.querySelector(
                                `[name='sub_organization_name']`,
                            )
                            if (subOrgInput && subOrgInput.value.trim() === '') {
                                this.errors['sub_organization_name'] =
                                    'Field ini wajib diisi untuk PR/PK.'
                            }
                        }

                        fields.forEach((name) => {
                            let input = document.querySelector(`[name='${name}']`)
                            if (input) {
                                if (input.type !== 'radio' && input.value.trim() === '') {
                                    this.errors[name] = 'Field ini wajib diisi.'
                                }
                            }
                        })

                        if (Object.keys(this.errors).length === 0) {
                            this.step = 2
                        }
                    },
                    validateStep2() {
                        this.errors = {}

                        let fields = [
                            'start_period',
                            'end_period',
                            'protectors',
                            'advisors',
                            'chairman',
                            'vice_chairmen',
                            'secretary',
                            'vice_secretaries',
                            'treasurer',
                            'vice_treasurers',
                            'organization_department_coordinator',
                            'organization_department_members',
                            'cadre_department_coordinator',
                            'cadre_department_members',
                            'dakwah_department_coordinator',
                            'dakwah_department_members',
                            'culture_department_coordinator',
                            'culture_department_members',
                            'economy_institution_director',
                            'economy_institution_members',
                            'press_institution_director',
                            'press_institution_members',
                            'brigade_institution_director',
                            'brigade_institution_members',
                        ]

                        fields.forEach((name) => {
                            let input = document.querySelector(`[name='${name}']`)
                            let inputJSON = document.querySelector(`[name='${name}[]']`)

                            if (
                                (input && input.value.trim() === '') ||
                                (inputJSON && inputJSON.value.trim() === '')
                            ) {
                                this.errors[name] = 'Field ini wajib diisi.'
                            }
                        })

                        if (Object.keys(this.errors).length === 0) {
                            Swal.fire({
                                title: 'Apakah Anda yakin ingin mengirim data ini?',
                                text: 'Pastikan semua data sudah sesuai sebelum dikirim.',
                                icon: 'warning',
                                showCancelButton: true,
                                cancelButtonText: 'Cek lagi',
                                confirmButtonText: 'Kirim',
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
                                        title: 'Kirim pengingat ke admin PC?',
                                        text: 'Setelah ini kamu akan diarahkan ke WhatsApp.',
                                        icon: 'question',
                                        showCancelButton: true,
                                        confirmButtonText: 'Kirim',
                                        cancelButtonText: 'Tidak',
                                        reverseButtons: true,
                                        customClass: {
                                            cancelButton: 'btn btn-secondary btn-lg',
                                            confirmButton: 'btn btn-success btn-lg',
                                            actions: 'swal-custom-actions',
                                        },
                                        buttonsStyling: false,
                                    }).then((reminderResult) => {
                                        if (reminderResult.isConfirmed) {
                                            const phone = '6285701929518' // Ganti dengan nomor admin PC (tanpa +)
                                            const pacName = '{{ $pacName }}'
                                            const message = encodeURIComponent(
                                                `Assalamu'alaikum wr wb, saya telah mengirimkan pengajuan SP untuk ${pacName}. Terima kasih`,
                                            )
                                            const waUrl = `https://wa.me/${phone}?text=${message}`
                                            window.open(waUrl, '_blank')
                                        }

                                        // Submit form setelah proses WA (tetap submit meskipun pilih kirim WA atau tidak)
                                        document.querySelector('form').submit()
                                    })
                                }
                            })
                        }
                    },
                }"
            >
                @csrf
                @method('PUT')
                <input type="hidden" name="type" value="{{ $letter->type }}" />

                <div class="row" x-show="step === 1">
                    <div class="my-4 px-5">
                        <h3 class="fw-semibold">{{ __('Tingkat Organisasi & Lampiran') }}</h3>
                    </div>

                    {{-- Organization Level Selection --}}
                    <div class="col-12 mb-4 px-5">
                        <div class="card bg-light">
                            <div class="card-body">
                                <label class="form-label fw-semibold">
                                    {{ __('Tingkat Organisasi') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="d-flex flex-wrap gap-4">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="organization_level"
                                            id="org_pac"
                                            value="PAC"
                                            x-model="orgLevel"
                                            checked
                                        />
                                        <label class="form-check-label" for="org_pac">
                                            <strong>PAC</strong>
                                            (Pimpinan Anak Cabang)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="organization_level"
                                            id="org_pr"
                                            value="PR"
                                            x-model="orgLevel"
                                        />
                                        <label class="form-check-label" for="org_pr">
                                            <strong>PR</strong>
                                            (Pimpinan Ranting)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="organization_level"
                                            id="org_pk"
                                            value="PK"
                                            x-model="orgLevel"
                                        />
                                        <label class="form-check-label" for="org_pk">
                                            <strong>PK</strong>
                                            (Pimpinan Komisariat)
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Sub Organization Name (only for PR/PK) --}}
                    <div class="col-12 mb-4 px-5" x-show="orgLevel === 'PR' || orgLevel === 'PK'" x-transition>
                        <p
                            x-show="errors.sub_organization_name"
                            class="text-danger mb-1 text-end"
                            x-text="errors.sub_organization_name"
                        ></p>
                        <label class="form-label fw-semibold">
                            <span x-show="orgLevel === 'PR'">{{ __('Nama Ranting') }}</span>
                            <span x-show="orgLevel === 'PK'">{{ __('Nama Komisariat') }}</span>
                            <span class="text-danger">*</span>
                        </label>
                        <input
                            type="text"
                            name="sub_organization_name"
                            class="form-control"
                            value="{{ old('sub_organization_name', $letter->sub_organization_name) }}"
                            :placeholder="orgLevel === 'PR' ? 'Contoh: Desa Karangsalam' : 'Contoh: MAN 1 Banyumas'"
                        />
                        <small class="text-muted">
                            <span x-show="orgLevel === 'PR'">
                                Masukkan nama desa/kelurahan untuk Pimpinan Ranting
                            </span>
                            <span x-show="orgLevel === 'PK'">
                                Masukkan nama sekolah/lembaga untuk Pimpinan Komisariat
                            </span>
                        </small>
                    </div>

                    <div class="my-4 px-5">
                        <h3 class="fw-semibold">{{ __('Lampiran-lampiran') }}</h3>
                        <div class="alert alert-info py-2" role="alert">
                            <i class="bi bi-info-circle me-2"></i>
                            Catatan: Anda tidak perlu mengunggah ulang file-file di bawah ini jika tidak ada perubahan.
                            File lama Anda akan tetap digunakan.
                        </div>
                    </div>
                    <div class="col-md-6 mt-3 px-5">
                        <p
                            x-show="errors.event_date"
                            class="text-danger mb-1 text-end"
                            x-text="errors.event_date"
                        ></p>
                        <x-input-form
                            name="event_date"
                            label="{{ __('Tanggal Pelaksanaan Konferancab/Rapat Anggota') }}"
                            type="date"
                            value="{{ old('event_date', $letter->event_date) }}"
                        />

                        <p
                            x-show="errors.event_location"
                            class="text-danger mb-1 text-end"
                            x-text="errors.event_location"
                        ></p>
                        <x-input-form
                            name="event_location"
                            label="{{ __('Tempat Pelaksanaan Konferancab/Rapat Anggota') }}"
                            type="text"
                            value="{{ old('event_location', $letter->event_location) }}"
                        />

                        <p
                            x-show="errors.pelantikan_date"
                            class="text-danger mb-1 text-end"
                            x-text="errors.pelantikan_date"
                        ></p>
                        <x-input-form
                            name="pelantikan_date"
                            label="{{ __('Tanggal Pelantikan') }}"
                            type="date"
                            value="{{ old('pelantikan_date', $letter->pelantikan_date) }}"
                        />
                        <small class="text-muted d-block mb-3" style="margin-top: -0.75rem">
                            Tanggal ini digunakan sebagai tanggal penetapan SP. SP berlaku 2 tahun sejak pelantikan.
                        </small>

                        <p
                            x-show="errors.documentation"
                            class="text-danger mb-1 text-end"
                            x-text="errors.documentation"
                        ></p>
                        <x-input-multiple-files
                            name="documentations"
                            label="{{ __('Dokumentasi Pelaksanaan Konferancab/Rapat Anggota') }}"
                            accept="application/vnd.openxmlformats-officedocument.wordprocessingml.document, image/jpeg, image/png, video/mp4"
                        />

                        <p
                            x-show="errors.request_letter"
                            class="text-danger mb-1 text-end"
                            x-text="errors.request_letter"
                        ></p>
                        <x-input-form
                            name="request_letter"
                            label="{{ __('Surat Permohonan Pengesahan kepada PC IPNU Kabupaten Banyumas') }}"
                            type="file"
                            accept="application/pdf"
                        />

                        <p
                            x-show="errors.mwc_recommendation"
                            class="text-danger mb-1 text-end"
                            x-text="errors.mwc_recommendation"
                        ></p>
                        <x-input-form
                            name="mwc_recommendation"
                            label="{{ __('Surat Rekomendasi dari MWC NU/PR NU Setempat') }}"
                            type="file"
                            accept="application/pdf"
                        />

                        <p
                            x-show="errors.mwc_letter_number"
                            class="text-danger mb-1 text-end"
                            x-text="errors.mwc_letter_number"
                        ></p>
                        <x-input-form
                            name="mwc_letter_number"
                            label="{{ __('No. Surat Rekomendasi dari MWC NU/PR NU Setempat') }}"
                            type="text"
                            value="{{ old('mwc_letter_number', $letter->mwc_letter_number) }}"
                        />
                        <p
                            x-show="errors.mwc_letter_date"
                            class="text-danger mb-1 text-end"
                            x-text="errors.mwc_letter_date"
                        ></p>
                        <x-input-form
                            name="mwc_letter_date"
                            label="{{ __('Tanggal Surat Rekomendasi dari MWC NU/PR NU Setempat') }}"
                            type="date"
                            value="{{ old('mwc_letter_date', $letter->mwc_letter_date) }}"
                        />
                    </div>

                    <div class="col-md-6 mt-3 px-5">
                        <p
                            x-show="errors.pac_recommendation"
                            class="text-danger mb-1 text-end"
                            x-text="errors.pac_recommendation"
                        ></p>
                        <x-input-form
                            name="pac_recommendation"
                            label="{{ __('Surat Rekomendasi PAC Setempat') }}"
                            type="file"
                            accept="application/pdf"
                        />

                        {{-- PAC Letter Number (for PR/PK) --}}
                        <div x-show="orgLevel === 'PR' || orgLevel === 'PK'" x-transition class="mt-3">
                            <p
                                x-show="errors.pac_letter_number"
                                class="text-danger mb-1 text-end"
                                x-text="errors.pac_letter_number"
                            ></p>
                            <x-input-form
                                name="pac_letter_number"
                                label="{{ __('No. Surat Rekomendasi PAC Setempat') }}"
                                type="text"
                                value="{{ old('pac_letter_number', $letter->pac_letter_number) }}"
                            />
                            <p
                                x-show="errors.pac_letter_date"
                                class="text-danger mb-1 text-end"
                                x-text="errors.pac_letter_date"
                            ></p>
                            <x-input-form
                                name="pac_letter_date"
                                label="{{ __('Tanggal Surat Rekomendasi PAC Setempat') }}"
                                type="date"
                                value="{{ old('pac_letter_date', $letter->pac_letter_date) }}"
                            />
                        </div>

                        <p
                            x-show="errors.election_report"
                            class="text-danger mb-1 text-end"
                            x-text="errors.election_report"
                        ></p>
                        <x-input-form
                            name="election_report"
                            label="{{ __('Berita Acara Pemilihan Ketua Hasil Konferancab/Rapat Anggota') }}"
                            type="file"
                            accept="application/pdf"
                        />

                        <p
                            x-show="errors.formation_report"
                            class="text-danger mb-1 text-end"
                            x-text="errors.formation_report"
                        ></p>
                        <x-input-form
                            name="formation_report"
                            label="{{ __('Berita Acara Penyusunan Kepengurusan Oleh Tim Formatur') }}"
                            type="file"
                            accept="application/pdf"
                        />

                        <p
                            x-show="errors.id_cv_photo_certificate"
                            class="text-danger mb-1 text-end"
                            x-text="errors.id_cv_photo_certificate"
                        ></p>
                        <x-input-form
                            name="id_cv_photo_certificate"
                            label="{{ __('Scan KTP, CV, Foto, Sertifikat Kaderisasi (Ketua, Sekretaris, dan Bendahara)') }}"
                            type="file"
                            accept="application/pdf"
                        />

                        <p
                            x-show="errors.management_structure"
                            class="text-danger mb-1 text-end"
                            x-text="errors.management_structure"
                        ></p>
                        <x-input-form
                            name="management_structure"
                            label="{{ __('Susunan Pengurus Lengkap') }}"
                            type="file"
                            accept="application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                        />
                    </div>
                    <div class="p-5 text-end">
                        <button type="button" class="btn btn-success btn-lg" @click="validateStep1()">
                            {{ __('Berikutnya') }}
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>
                </div>

                <div class="container">
                    <div class="row" x-show="step === 2">
                        <div class="col-12">
                            <h3 class="fw-semibold my-5 px-3">{{ __('Susunan Pengurus') }}</h3>
                        </div>

                        {{-- Masa Khidmat --}}
                        <div class="col-12 mb-4 px-3">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header border-bottom bg-white py-3">
                                    <h5 class="fw-bold text-dark mb-0">
                                        {{ __('Masa Khidmat') }}
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p
                                                x-show="errors.start_period"
                                                class="text-danger mb-1 text-end"
                                                x-text="errors.start_period"
                                            ></p>
                                            <x-input-form
                                                name="start_period"
                                                label="{{ __('Tahun Mulai') }}"
                                                type="number"
                                                min="1900"
                                                max="2100"
                                                layout="vertical"
                                            />
                                        </div>
                                        <div class="col-md-6">
                                            <p
                                                x-show="errors.end_period"
                                                class="text-danger mb-1 text-end"
                                                x-text="errors.end_period"
                                            ></p>
                                            <x-input-form
                                                name="end_period"
                                                label="{{ __('Tahun Berakhir') }}"
                                                type="number"
                                                min="1900"
                                                max="2100"
                                                layout="vertical"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Pelindung & Pembina --}}
                        <div class="col-12 col-md-6 mb-4 px-3">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-header border-bottom bg-white py-3">
                                    <h5 class="fw-bold text-dark mb-0">
                                        {{ __('Pelindung') }}
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <p
                                        x-show="errors.protectors"
                                        class="text-danger mb-1 text-end"
                                        x-text="errors.protectors"
                                    ></p>
                                    <x-input-json
                                        name="protectors"
                                        label="{{ __('Nama Pelindung') }}"
                                        count="10"
                                        layout="vertical"
                                        :values="old('protectors', $letter->protectors)"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-4 px-3">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-header border-bottom bg-white py-3">
                                    <h5 class="fw-bold text-dark mb-0">
                                        {{ __('Pembina') }}
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <p
                                        x-show="errors.advisors"
                                        class="text-danger mb-1 text-end"
                                        x-text="errors.advisors"
                                    ></p>
                                    <x-input-json
                                        name="advisors"
                                        label="{{ __('Nama Pembina') }}"
                                        count="10"
                                        layout="vertical"
                                        :values="old('advisors', $letter->advisors)"
                                    />
                                </div>
                            </div>
                        </div>

                        {{-- Pengurus Harian --}}
                        <div class="col-12 mb-4 px-3">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header border-bottom bg-white py-3">
                                    <h5 class="fw-bold text-dark mb-0">
                                        {{ __('Pengurus Harian') }}
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-4 mb-3">
                                            <p
                                                x-show="errors.chairman"
                                                class="text-danger mb-1 text-end"
                                                x-text="errors.chairman"
                                            ></p>
                                            <x-input-form
                                                name="chairman"
                                                label="{{ __('Ketua') }}"
                                                type="text"
                                                layout="vertical"
                                                value="{{ old('chairman', $letter->chairman) }}"
                                            />
                                        </div>
                                        <div class="col-12 col-md-4 mb-3">
                                            <p
                                                x-show="errors.secretary"
                                                class="text-danger mb-1 text-end"
                                                x-text="errors.secretary"
                                            ></p>
                                            <x-input-form
                                                name="secretary"
                                                label="{{ __('Sekretaris') }}"
                                                type="text"
                                                layout="vertical"
                                                value="{{ old('secretary', $letter->secretary) }}"
                                            />
                                        </div>
                                        <div class="col-12 col-md-4 mb-3">
                                            <p
                                                x-show="errors.treasurer"
                                                class="text-danger mb-1 text-end"
                                                x-text="errors.treasurer"
                                            ></p>
                                            <x-input-form
                                                name="treasurer"
                                                label="{{ __('Bendahara') }}"
                                                type="text"
                                                layout="vertical"
                                                value="{{ old('treasurer', $letter->treasurer) }}"
                                            />
                                        </div>
                                        <div class="col-12 col-md-4 mb-3">
                                            <p
                                                x-show="errors.vice_chairmen"
                                                class="text-danger mb-1 text-end"
                                                x-text="errors.vice_chairmen"
                                            ></p>
                                            <x-input-json
                                                name="vice_chairmen"
                                                label="{{ __('Wakil Ketua') }}"
                                                layout="vertical"
                                                :values="old('vice_chairmen', $letter->vice_chairmen)"
                                            />
                                        </div>
                                        <div class="col-12 col-md-4 mb-3">
                                            <p
                                                x-show="errors.vice_secretaries"
                                                class="text-danger mb-1 text-end"
                                                x-text="errors.vice_secretaries"
                                            ></p>
                                            <x-input-json
                                                name="vice_secretaries"
                                                label="{{ __('Wakil Sekretaris') }}"
                                                layout="vertical"
                                                :values="old('vice_secretaries', $letter->vice_secretaries)"
                                            />
                                        </div>
                                        <div class="col-12 col-md-4 mb-3">
                                            <p
                                                x-show="errors.vice_treasurers"
                                                class="text-danger mb-1 text-end"
                                                x-text="errors.vice_treasurers"
                                            ></p>
                                            <x-input-json
                                                name="vice_treasurers"
                                                label="{{ __('Wakil Bendahara') }}"
                                                layout="vertical"
                                                :values="old('vice_treasurers', $letter->vice_treasurers)"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Departemen-departemen (2 kolom) --}}
                        @php
                            $departments = [
                                ['key' => 'organization_department', 'label' => 'Departemen Organisasi', 'role' => 'coordinator'],
                                ['key' => 'cadre_department', 'label' => 'Departemen Kaderisasi', 'role' => 'coordinator'],
                                ['key' => 'dakwah_department', 'label' => 'Departemen Dakwah', 'role' => 'coordinator'],
                                ['key' => 'culture_department', 'label' => 'Departemen Olahraga, Seni, & Budaya', 'role' => 'coordinator'],
                            ];
                        @endphp

                        @foreach ($departments as $dept)
                            <div class="col-12 col-md-6 mb-4 px-3">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-header border-bottom bg-white py-3">
                                        <h5 class="fw-bold text-dark mb-0">
                                            {{ __($dept['label']) }}
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <p
                                            x-show="errors.{{ $dept['key'] }}_coordinator"
                                            class="text-danger mb-1 text-end"
                                            x-text="errors.{{ $dept['key'] }}_coordinator"
                                        ></p>
                                        <x-input-form
                                            name="{{ $dept['key'] }}_coordinator"
                                            label="{{ __('Koordinator') }}"
                                            type="text"
                                            layout="vertical"
                                            value="{{ old($dept['key'].'_coordinator', $letter->{$dept['key'].'_coordinator'}) }}"
                                        />
                                        <p
                                            x-show="errors.{{ $dept['key'] }}_members"
                                            class="text-danger mb-1 text-end"
                                            x-text="errors.{{ $dept['key'] }}_members"
                                        ></p>
                                        <x-input-json
                                            name="{{ $dept['key'] }}_members"
                                            label="{{ __('Anggota') }}"
                                            layout="vertical"
                                            :values="old($dept['key'].'_members', $letter->{$dept['key'].'_members'})"
                                        />
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- Lembaga-lembaga (3 kolom) --}}
                        @php
                            $institutions = [
                                ['key' => 'economy_institution', 'label' => 'Lembaga Ekonomi & Kewirausahaan', 'role' => 'director'],
                                ['key' => 'press_institution', 'label' => 'Lembaga Pers & Penerbitan', 'role' => 'director'],
                                ['key' => 'brigade_institution', 'label' => 'Lembaga Corps Brigade Pembangunan', 'role' => 'director'],
                            ];
                        @endphp

                        @foreach ($institutions as $inst)
                            <div class="col-12 col-md-4 mb-4 px-3">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-header border-bottom bg-white py-3">
                                        <h5 class="fw-bold text-dark mb-0" style="font-size: 0.95rem">
                                            {{ __($inst['label']) }}
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <p
                                            x-show="errors.{{ $inst['key'] }}_director"
                                            class="text-danger mb-1 text-end"
                                            x-text="errors.{{ $inst['key'] }}_director"
                                        ></p>
                                        <x-input-form
                                            name="{{ $inst['key'] }}_director"
                                            label="{{ __('Direktur') }}"
                                            type="text"
                                            layout="vertical"
                                            value="{{ old($inst['key'].'_director', $letter->{$inst['key'].'_director'}) }}"
                                        />
                                        <p
                                            x-show="errors.{{ $inst['key'] }}_members"
                                            class="text-danger mb-1 text-end"
                                            x-text="errors.{{ $inst['key'] }}_members"
                                        ></p>
                                        <x-input-json
                                            name="{{ $inst['key'] }}_members"
                                            label="{{ __('Anggota') }}"
                                            layout="vertical"
                                            :values="old($inst['key'].'_members', $letter->{$inst['key'].'_members'})"
                                        />
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="col-12 px-3">
                            <div
                                class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 p-4"
                            >
                                <button type="button" class="btn btn-secondary btn-lg" @click="step = 1">
                                    <i class="bi bi-chevron-left"></i>
                                    {{ __('Sebelumnya') }}
                                </button>
                                <button type="button" class="btn btn-success btn-lg" @click="validateStep2()">
                                    {{ __('Kirim') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
