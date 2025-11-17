@section('title')
    {{ __('Anggota') }}
@endsection

@extends('admins.layout')

@push('script')
    @vite('resources/js/plugins/alpine.js')
@endpush

@section('content')
    <x-breadcrumb :values="[__('Anggota'), __('Tambah Anggota')]"></x-breadcrumb>

    <div class="card">
        <div class="card-header bg-transparent text-center">
            <div class="d-flex align-items-center p-4">
                <div class="text-start">
                    <a href="{{ route('dashboard.members.index') }}" class="btn fs-4 border-0">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                </div>
                <div class="d-flex flex-column w-100">
                    <h3 class="fw-bold">{{ __('Tambah Anggota') }}</h3>
                </div>
            </div>
        </div>

        <div class="card-body px-3 px-md-5 py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <form action="{{ route('dashboard.members.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <form action="{{ route('dashboard.members.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                            
                                {{-- Nama dan Foto --}}
                                <div class="mb-3">
                                    <x-input-form name="name" label="Nama Lengkap sesuai KTP" />
                                </div>
                                <div class="mb-3">
                                    <x-input-form name="photo" label="Foto Profil" type="file" accept="image/jpeg,image/png" required="0" />
                                </div>
                            
                                {{-- Gender dan No HP --}}
                                    <div class="mb-3">
                                        <x-input-select name="gender" label="{{ __('Jenis Kelamin') }}" :options="$genders" />
                                    </div>
                                    <div class="mb-3">
                                        <x-input-form name="phone" label="{{ __('No. HP') }}" />
                                    </div>
                            
                                {{-- Tempat dan Tanggal Lahir --}}
                                    <div class="mb-3">
                                        <x-input-form name="place_of_birth" label="{{ __('Tempat Lahir') }}" />
                                    </div>
                                    <div class="mb-3">
                                        <x-input-form name="date_of_birth" label="{{ __('Tanggal Lahir') }}" type="date" />
                                    </div>
                            
                                {{-- Alamat --}}
                                <div class="mb-4">
                                    <x-input-textarea name="address" label="{{ __('Alamat Lengkap') }}" />
                                </div>
                            
                                {{-- Kaderisasi Formal --}}
                                <div class="mb-3 row"
                                     x-data="{
                                         formalCadreLevels: {{ json_encode(old('formal_cadre_levels', []) ?: []) }},
                                     }"
                                     x-init="
                                        $watch('formalCadreLevels', value => {
                                            if (value.includes('lakmud') && !value.includes('makesta')) {
                                                value.push('makesta');
                                            }
                                        })
                                     ">
                                    <label class="col-md-4 col-form-label text-md-end">{{ __('Jenjang Kaderisasi Formal') }}</label>
                                    <div class="col-md-8">
                                        <div class="row g-3">
                                            @foreach ($formalCadreLevels as $level)
                                                <div class="col-md-4">
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
                                                            {{ in_array($level, old('formal_cadre_levels[]', [])) ? 'checked' : '' }}
                                                        />
                                                        <label class="form-check-label" for="formal_cadre_levels_{{ $level }}">
                                                            {{ ucfirst($level) }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                
                                        {{-- Tambahan tahun --}}
                                        <div class="row mt-3 g-3">
                                            <template x-if="formalCadreLevels.includes('makesta')">
                                                <div class="col-md-4">
                                                    <x-input-select name="makesta_year" label="{{ __('Tahun Makesta') }}" :options="$years" required="0" />
                                                </div>
                                            </template>
                                            <template x-if="formalCadreLevels.includes('lakmud')">
                                                <div class="col-md-4">
                                                    <x-input-select name="lakmud_year" label="{{ __('Tahun Lakmud') }}" :options="$years" required="0" />
                                                </div>
                                            </template>
                                            <template x-if="formalCadreLevels.includes('lakut')">
                                                <div class="col-md-4">
                                                    <x-input-select name="lakut_year" label="{{ __('Tahun Lakut') }}" :options="$years" required="0" />
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            
                                {{-- Kaderisasi Non-Formal --}}
                                <div class="mb-3 row"
                                     x-data="{ nonFormalCadreLevels: {{ json_encode(old('non_formal_cadre_levels', []) ?: []) }} }">
                                    <label class="col-md-4 col-form-label text-md-end">{{ __('Jenjang Kaderisasi Non-Formal') }}</label>
                                    <div class="col-md-8">
                                        <div class="row g-3">
                                            @foreach ($nonFormalCadreLevels as $level)
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input
                                                            type="checkbox"
                                                            id="non_formal_cadre_levels_{{ $level }}"
                                                            name="non_formal_cadre_levels[]"
                                                            value="{{ $level }}"
                                                            class="form-check-input"
                                                            x-model="nonFormalCadreLevels"
                                                            {{ in_array($level, old('non_formal_cadre_levels[]', [])) ? 'checked' : '' }}
                                                        />
                                                        <label class="form-check-label" for="non_formal_cadre_levels_{{ $level }}">
                                                            {{ ucfirst($level) }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            
                                {{-- PAC & Keanggotaan --}}
                                @if (in_array(auth()->user()->role_id, [1, 2]))
                                    <div class="row g-4 mb-3">
                                        <div class="col-md-6">
                                            <x-input-select name="pac_id" label="{{ __('PAC') }}" :options="$pacList" />
                                        </div>
                                        <div class="col-md-6">
                                            <x-input-select name="membership_status" label="{{ __('Status Keanggotaan') }}" :options="$membershipStatus" />
                                        </div>
                                    </div>
                                @endif
                            
                                {{-- Tombol --}}
                                <div class="d-flex flex-column flex-md-row justify-content-end gap-3 mt-4">
                                    <a href="{{ route('dashboard.members.index') }}" class="btn btn-outline-secondary w-100 w-md-auto">
                                        {{ __('Kembali') }}
                                    </a>
                                    <button type="submit" class="btn btn-success w-100 w-md-auto">
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
