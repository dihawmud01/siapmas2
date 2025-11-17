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
    <x-breadcrumb :values="[
        __('Surat-menyurat'),
        __('Pengajuan Surat Pengesahan (SP)'),
        __('Buat Pengajuan'),
        strtoupper(request()->query('type')),
    ]"></x-breadcrumb>


    <div class="card">
        <div class="card-header bg-transparent">
            <div class="d-flex align-items-center p-4">
                <div class="d-flex flex-column w-100">
                    <h3 class="fw-bold">{{ __('Form Pengajuan Surat Pengesahan PAC/PR/PK') }} -
                        {{ strtoupper(request()->query('type')) }}</h3>
                </div>
            </div>
        </div>

        <div class="card-body p-4">
            <form method="POST"
                action="{{ route('dashboard.letters.validation-submission.store', ['type' => request()->query('type') === 'ippnu' ? 'IPPNU' : 'IPNU']) }}"
                enctype="multipart/form-data" x-data="{
                    step: 1,
                    errors: {},
                    waPhone: '{{ $adminPcPhone }}',
                    pacName: '{{ $pacName }}',
                    validateStep1() {
                        this.errors = {}
                
                        let fields = [
                            'type',
                            'event_date',
                            'event_location',
                            'documentation',
                            'request_letter',
                            'mwc_recommendation',
                            'mwc_letter_number',
                            'pac_recommendation',
                            'election_report',
                            'formation_report',
                            'id_cv_photo_certificate',
                            'management_structure',
                        ]
                
                        fields.forEach((name) => {
                            let input = document.querySelector(`[name='${name}']`)
                            if (input) {
                                if (
                                    (input.type === 'file' && input.files.length === 0) ||
                                    (input.type !== 'file' && input.value.trim() === '')
                                ) {
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
                                            const phone = '6285701929518'; // Ganti dengan nomor admin PC (tanpa +)
                                            const pacName = '{{ $pacName }}';
                                            const message = encodeURIComponent(`Assalamu'alaikum wr wb, saya telah mengirimkan pengajuan SP untuk ${pacName}. Terima kasih`);
                                            const waUrl = `https://wa.me/${phone}?text=${message}`;
                                            window.open(waUrl, '_blank');
                                        }
                
                                        // Submit form setelah proses WA (tetap submit meskipun pilih kirim WA atau tidak)
                                        document.querySelector('form').submit();
                                    });
                                }
                
                            })
                        }
                    },
                }">
                @csrf

                <div class="row" x-show="step === 1">
                    <div class="my-4 px-5">
                        <h3 class="fw-semibold">{{ __('Lampiran-lampiran') }}</h3>
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
                        />

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

        <div class="col-12 col-md-6 mb-4 px-3">
            <div class="mb-5">
                <p x-show="errors.start_period" class="text-danger mb-1 text-end" x-text="errors.start_period"></p>
                <x-input-form name="start_period" label="{{ __('Tahun Mulai Masa Khidmat') }}" type="number" min="1900" max="2100" />

                <p x-show="errors.end_period" class="text-danger mb-1 text-end" x-text="errors.end_period"></p>
                <x-input-form name="end_period" label="{{ __('Tahun Berakhir Masa Khidmat') }}" type="number" min="1900" max="2100" />
            </div>

            <div class="mb-5">
                <p x-show="errors.protectors" class="text-danger mb-1 text-end" x-text="errors.protectors"></p>
                <x-input-json name="protectors" label="{{ __('Pelindung') }}" count="10" />

                <p x-show="errors.advisors" class="text-danger mb-1 text-end" x-text="errors.advisors"></p>
                <x-input-json name="advisors" label="{{ __('Pembina') }}" count="10" />
            </div>

            <div class="mb-5">
                <div class="border-bottom mb-3">
                    <h5 class="fw-semibold">{{ __('Pengurus Harian') }}</h5>
                </div>

                <p x-show="errors.chairman" class="text-danger mb-1 text-end" x-text="errors.chairman"></p>
                <x-input-form name="chairman" label="{{ __('Ketua') }}" type="text" />

                <p x-show="errors.vice_chairmen" class="text-danger mb-1 text-end" x-text="errors.vice_chairmen"></p>
                <x-input-json name="vice_chairmen" label="{{ __('Wakil Ketua') }}" />

                <p x-show="errors.secretary" class="text-danger mb-1 text-end" x-text="errors.secretary"></p>
                <x-input-form name="secretary" label="{{ __('Sekretaris') }}" type="text" />

                <p x-show="errors.vice_secretaries" class="text-danger mb-1 text-end" x-text="errors.vice_secretaries"></p>
                <x-input-json name="vice_secretaries" label="{{ __('Wakil Sekretaris') }}" />

                <p x-show="errors.treasurer" class="text-danger mb-1 text-end" x-text="errors.treasurer"></p>
                <x-input-form name="treasurer" label="{{ __('Bendahara') }}" type="text" />

                <p x-show="errors.vice_treasurers" class="text-danger mb-1 text-end" x-text="errors.vice_treasurers"></p>
                <x-input-json name="vice_treasurers" label="{{ __('Wakil Bendahara') }}" />
            </div>

            <div class="mb-5">
                <div class="border-bottom mb-3">
                    <h5 class="fw-semibold">{{ __('Departemen Organisasi') }}</h5>
                </div>

                <p x-show="errors.organization_department_coordinator" class="text-danger mb-1 text-end" x-text="errors.organization_department_coordinator"></p>
                <x-input-form name="organization_department_coordinator" label="{{ __('Koordinator') }}" type="text" />

                <p x-show="errors.organization_department_members" class="text-danger mb-1 text-end" x-text="errors.organization_department_members"></p>
                <x-input-json name="organization_department_members" label="{{ __('Anggota') }}" />
            </div>

            <div class="mb-5">
                <div class="border-bottom mb-3">
                    <h5 class="fw-semibold">{{ __('Departemen Kaderisasi') }}</h5>
                </div>

                <p x-show="errors.cadre_department_coordinator" class="text-danger mb-1 text-end" x-text="errors.cadre_department_coordinator"></p>
                <x-input-form name="cadre_department_coordinator" label="{{ __('Koordinator') }}" type="text" />

                <p x-show="errors.cadre_department_members" class="text-danger mb-1 text-end" x-text="errors.cadre_department_members"></p>
                <x-input-json name="cadre_department_members" label="{{ __('Anggota') }}" />
            </div>
        </div>

        <div class="col-12 col-md-6 mb-4 px-3">
            <div class="mb-5">
                <div class="border-bottom mb-3">
                    <h5 class="fw-semibold">{{ __('Departemen Dakwah') }}</h5>
                </div>

                <p x-show="errors.dakwah_department_coordinator" class="text-danger mb-1 text-end" x-text="errors.dakwah_department_coordinator"></p>
                <x-input-form name="dakwah_department_coordinator" label="{{ __('Koordinator') }}" type="text" />

                <p x-show="errors.dakwah_department_members" class="text-danger mb-1 text-end" x-text="errors.dakwah_department_members"></p>
                <x-input-json name="dakwah_department_members" label="{{ __('Anggota') }}" />
            </div>

            <div class="mb-5">
                <div class="border-bottom mb-3">
                    <h5 class="fw-semibold">{{ __('Departemen Olahraga, Seni, dan Budaya') }}</h5>
                </div>

                <p x-show="errors.culture_department_coordinator" class="text-danger mb-1 text-end" x-text="errors.culture_department_coordinator"></p>
                <x-input-form name="culture_department_coordinator" label="{{ __('Koordinator') }}" type="text" />

                <p x-show="errors.culture_department_members" class="text-danger mb-1 text-end" x-text="errors.culture_department_members"></p>
                <x-input-json name="culture_department_members" label="{{ __('Anggota') }}" />
            </div>

            <div class="mb-5">
                <div class="border-bottom mb-3">
                    <h5 class="fw-semibold">{{ __('Lembaga Ekonomi dan Kewirausahaan') }}</h5>
                </div>

                <p x-show="errors.economy_institution_director" class="text-danger mb-1 text-end" x-text="errors.economy_institution_director"></p>
                <x-input-form name="economy_institution_director" label="{{ __('Direktur') }}" type="text" />

                <p x-show="errors.economy_institution_members" class="text-danger mb-1 text-end" x-text="errors.economy_institution_members"></p>
                <x-input-json name="economy_institution_members" label="{{ __('Anggota') }}" />
            </div>

            <div class="mb-5">
                <div class="border-bottom mb-3">
                    <h5 class="fw-semibold">{{ __('Lembaga Pers dan Penerbitan') }}</h5>
                </div>

                <p x-show="errors.press_institution_director" class="text-danger mb-1 text-end" x-text="errors.press_institution_director"></p>
                <x-input-form name="press_institution_director" label="{{ __('Direktur') }}" type="text" />

                <p x-show="errors.press_institution_members" class="text-danger mb-1 text-end" x-text="errors.press_institution_members"></p>
                <x-input-json name="press_institution_members" label="{{ __('Anggota') }}" />
            </div>

            <div class="mb-5">
                <div class="border-bottom mb-3">
                    <h5 class="fw-semibold">{{ __('Lembaga Corps Brigade Pembangunan') }}</h5>
                </div>

                <p x-show="errors.brigade_institution_director" class="text-danger mb-1 text-end" x-text="errors.brigade_institution_director"></p>
                <x-input-form name="brigade_institution_director" label="{{ __('Direktur') }}" type="text" />

                <p x-show="errors.brigade_institution_members" class="text-danger mb-1 text-end" x-text="errors.brigade_institution_members"></p>
                <x-input-json name="brigade_institution_members" label="{{ __('Anggota') }}" />
            </div>
        </div>

        <div class="col-12 px-3">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center p-4 gap-3">
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