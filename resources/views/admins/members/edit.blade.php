@section('title')
    {{ __('Anggota') }}
@endsection

@extends('admins.layout')

@push('script')
    @vite('resources/js/plugins/alpine.js')
@endpush

@section('content')
    <x-breadcrumb :values="[__('Anggota'), __('Edit Anggota')]" />

    <div class="card">
        <div class="card-header bg-transparent text-center">
            <div class="d-flex align-items-center p-4">
                <div class="text-start">
                    <a href="{{ route('dashboard.members.index') }}" class="btn fs-4 border-0">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                </div>
                <div class="d-flex flex-column w-100">
                    <h3 class="fw-bold">{{ __('Edit Anggota') }}</h3>
                </div>
            </div>
        </div>

        <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <div class="row mt-5 pt-4">
                <form
                    action="{{ route('dashboard.members.update', $member) }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf
                    @method('PUT')

                    <x-input-form name="name" label="{{ __('Nama Lengkap sesuai KTP') }}" :value="$member->name" />

                    <div class="d-flex">
                        <x-input-form
                            name="photo"
                            label="{{ __('Foto Profil') }}"
                            type="file"
                            accept="image/jpeg,image/png"
                            required="0"
                        />
                        <div id="imagePreviewContainer" class="mb-2">
                            <a
                                id="imageLink"
                                href="{{ asset('storage/images/' . ($member['photo'] != 'default.png' ? 'members/' . strtolower(str_replace(' ', '-', $member->pac->pac)) . '/photo/' . $member['photo'] : 'default.png')) }}"
                            >
                                <img
                                    src="{{ asset('storage/images/' . ($member['photo'] != 'default.png' ? 'members/' . strtolower(str_replace(' ', '-', $member->pac->pac)) . '/photo/' . $member['photo'] : 'default.png')) }}"
                                    class="rounded-circle ms-2"
                                    style="aspect-ratio: 1 / 1; object-fit: cover; width: 76px; height: 76px"
                                    alt="{{ __('Foto Anggota') }}"
                                />
                            </a>
                        </div>
                    </div>

                    <x-input-select
                        name="gender"
                        label="{{ __('Jenis Kelamin') }}"
                        :options="$genders"
                        :selected="$member->gender->value"
                    />
                    <x-input-form
                        name="place_of_birth"
                        label="{{ __('Tempat Lahir') }}"
                        :value="$member->place_of_birth"
                    />
                    <x-input-form
                        name="date_of_birth"
                        label="{{ __('Tanggal Lahir') }}"
                        type="date"
                        :value="$member->date_of_birth"
                    />
                    <x-input-textarea name="address" label="{{ __('Alamat Lengkap') }}" :value="$member->address" />

                    <div
                        x-data="{
                            formalCadreLevels: {{ json_encode($formalCadreLevels) }},
                        }"
                        x-init="
                            $watch('formalCadreLevels', (value) => {
                                if (value.includes('lakmud') && ! value.includes('makesta')) {
                                    value.push('makesta')
                                }
                            })
                        "
                    >
                        <div class="d-flex align-items-start mb-4">
                            <label class="form-label label me-3 text-start">
                                {{ __('Jenjang Kaderisasi Formal') }}
                            </label>
                            <div class="d-flex flex-column w-100">
                                @foreach ($formalCadreLevelList as $level)
                                    <div class="form-check">
                                        <input
                                            type="checkbox"
                                            id="formal_cadre_levels_{{ $level }}"
                                            name="formal_cadre_levels[]"
                                            value="{{ $level }}"
                                            class="form-check-input"
                                            x-model="formalCadreLevels"
                                            @change="$dispatch('checkbox-changed', '{{ $level }}')"
                                            :disabled="('{{ $level }}' === 'makesta' && formalCadreLevels.includes('lakmud'))"
                                            {{ in_array($level, $formalCadreLevels) ? 'checked' : '' }}
                                        />
                                        <label for="formal_cadre_levels_{{ $level }}" class="form-check-label">
                                            {{ ucfirst($level) }}
                                        </label>
                                    </div>
                                @endforeach

                                <template x-if="formalCadreLevels.includes('makesta')">
                                    <input type="hidden" name="formal_cadre_levels[]" value="makesta" />
                                </template>
                            </div>
                        </div>

                        <div x-show="formalCadreLevels.includes('makesta')">
                            <x-input-select
                                name="makesta_year"
                                label="{{ __('Tahun Makesta') }}"
                                :options="$years"
                                :selected="$member->makesta_year"
                                required="0"
                            />
                        </div>

                        <div x-show="formalCadreLevels.includes('lakmud')">
                            <x-input-select
                                name="lakmud_year"
                                label="{{ __('Tahun Lakmud') }}"
                                :options="$years"
                                :selected="$member->lakmud_year"
                                required="0"
                            />
                        </div>

                        <div x-show="formalCadreLevels.includes('lakut')">
                            <x-input-select
                                name="lakut_year"
                                label="{{ __('Tahun Lakut') }}"
                                :options="$years"
                                :selected="$member->lakut_year"
                                required="0"
                            />
                        </div>
                    </div>

                    <div
                        x-data="{
                            nonFormalCadreLevels: {{ json_encode($nonFormalCadreLevels) }},
                            toggleLevel(level) {
                                if (this.nonFormalCadreLevels.includes(level)) {
                                    this.nonFormalCadreLevels = this.nonFormalCadreLevels.filter(
                                        (l) => l !== level,
                                    )
                                } else {
                                    this.nonFormalCadreLevels.push(level)
                                }
                            },
                        }"
                    >
                        <div class="d-flex align-items-start mb-4">
                            <label class="form-label label me-3 text-start">
                                {{ __('Jenjang Kaderisasi Non-Formal') }}
                            </label>
                            <div class="d-flex flex-column w-100">
                                @foreach ($nonFormalCadreLevelList as $level)
                                    <div class="form-check">
                                        <input
                                            type="checkbox"
                                            id="non_formal_cadre_levels_{{ $level }}"
                                            name="non_formal_cadre_levels[]"
                                            value="{{ $level }}"
                                            class="form-check-input"
                                            @change="$dispatch('checkbox-changed', '{{ $level }}')"
                                            {{ in_array($level, $nonFormalCadreLevels) ? 'checked' : '' }}
                                        />
                                        <label for="non_formal_cadre_levels_{{ $level }}" class="form-check-label">
                                            {{ ucfirst($level) }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <x-input-form name="phone" label="{{ __('No. HP') }}" :value="old('phone', $member->phone)" />

                    @if (in_array(auth()->user()->role_id, [1, 2]))
                        <x-input-select
                            name="pac_id"
                            label="{{ __('PAC') }}"
                            :options="$pacList"
                            :selected="$member->pac_id"
                        />
                        <x-input-select
                            name="membership_status"
                            label="{{ __('Status Keanggotaan') }}"
                            :options="$membershipStatus"
                            :selected="$member->membership_status->value"
                        />
                    @endif

                    <div class="d-flex align-items-center justify-content-end">
                        <a
                            href="{{ route('dashboard.members.index') }}"
                            class="text-secondary text-decoration-none me-3"
                        >
                            {{ __('Kembali') }}
                        </a>
                        <button type="submit" class="btn btn-success">
                            {{ __('Update') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection