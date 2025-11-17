@extends('admins.layout')

@section('title')
    {{ __('Surat Pengesahan (SP)') }}
@endsection

@section('content')
        <x-breadcrumb :values="[__('Surat-menyurat'), __('Pengajuan Surat Pengesahan (SP)'), strtoupper($type)]">
        @if (in_array(auth()->user()->role_id, [3]))
            @if (!$letters->isEmpty())
                <a href="{{ route('dashboard.letters.validation-submission.create', ['type' => request()->query('type')]) }}" 
                class="btn btn-success btn-lg">
                    <i class="bi bi-envelope-arrow-up me-2"></i>
                    {{ __('Ajukan SP') }}
                </a>
            @endif
        @endif
    </x-breadcrumb>

    <!-- Menampilkan data berdasarkan pilihan -->
    @if ($letters->isEmpty())
        <div class="d-flex align-items-center justify-content-center empty-content p-4">
            <div class="text-center">
                <h1 class="text-secondary mb-3">{{ __('Belum ada pengajuan SP yang dilakukan') }}</h1>
                <a href="{{ route('dashboard.letters.validation-submission.create', ['type' => request()->query('type')]) }}" 
                class="btn btn-success btn-lg">
                    <i class="bi bi-envelope-arrow-up me-2"></i>
                    {{ __('Ajukan SP') }}
                </a>
            </div>
        </div>
    @endif

    @foreach ($letters as $letter)
        <x-sp-card :letter="$letter" />
    @endforeach
@endsection
