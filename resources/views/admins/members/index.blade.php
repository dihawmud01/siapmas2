@section('title')
    {{ __('Anggota') }}
@endsection

@extends('admins.layout')

@push('script')
    @vite('resources/js/plugins/glightbox.js')
@endpush

@section('content')
    <x-breadcrumb :values="[__('Anggota')]"></x-breadcrumb>

    @if ($members->isEmpty())
        <div class="d-flex align-items-center justify-content-center empty-content p-4">
            <div class="text-center">
                <h1 class="text-secondary mb-3">{{ __('Belum ada anggota yang terdaftar') }}</h1>
                <a href="{{ route('dashboard.members.create') }}" class="btn btn-success btn-lg">
                    <i class="bi bi-person-plus-fill me-2"></i>
                    {{ __('Tambah Anggota') }}
                </a>
            </div>
        </div>
    @endif

    @if (! $members->isEmpty())
        <div class="card info-card sales-card min-vh-100">
            <div class="card-header bg-transparent text-center">
                <div class="d-flex align-items-center p-4">
                    <div class="d-flex flex-column w-100">
                        <h3 class="fw-bold">
                            {{ __('Data Anggota') }}
                            @if (auth()->user()->role_id == 3)
                                {{ in_array(auth()->user()->pac_id, [28, 29]) ? ' ' . ucwords(strtolower(auth()->user()->pac->pac)) : ' PAC ' . ucwords(strtolower(auth()->user()->pac->pac)) }}
                            @endif
                        </h3>
                    </div>
                </div>
            </div>
            <div class="container-fluid p-5">
                <div class="row align-items-center mb-3">
                    <div class="col-12 d-flex justify-content-between align-items-end">
                        <h5 class="fw-semibold mb-2">{{ __('Total Anggota: ') }} {{ $totalMembers }}</h5>

                        <div class="d-flex w-50 justify-content-end">
                        @php
                            $filter = request('filter'); // Ambil filter dari request
                            $search = request('search'); // Ambil query pencarian dari request
                            $isFiltered = !empty($filter) && empty($search); // Cek apakah sedang dalam mode filter atau tidak
                        @endphp
                <form action="{{ route('dashboard.members.index') }}" method="GET" class="w-100">
    <div class="row g-2">
        <!-- Tombol Filter -->
        <div class="col-12 col-md-auto d-flex flex-wrap gap-2">
            @php
                $filter = request('filter');
                $search = request('search');
            @endphp

            <input type="hidden" name="search" value="{{ $search }}"> {{-- pertahankan pencarian saat klik filter --}}

            <a href="{{ route('dashboard.members.index', ['filter' => 'IPNU', 'search' => $search]) }}" 
               class="btn {{ $filter === 'IPNU' ? 'btn-success' : 'btn-outline-dark' }}">
                IPNU
            </a>
            <a href="{{ route('dashboard.members.index', ['filter' => 'IPPNU', 'search' => $search]) }}" 
               class="btn {{ $filter === 'IPPNU' ? 'btn-success' : 'btn-outline-dark' }}">
                IPPNU
            </a>
            <a href="{{ route('dashboard.members.index') }}" 
               class="btn {{ !$filter && !$search ? 'btn-success' : 'btn-outline-dark' }}">
                Semua
            </a>
        </div>

        <!-- Input Pencarian -->
        <div class="col-12 col-md">
            <div class="input-group">
                <input
                    type="text"
                    name="search"
                    id="search-input"
                    class="form-control"
                    value="{{ request('search') }}"
                    placeholder="Cari Nama"
                />
                <button type="button" id="clear-search" class="btn btn-outline-secondary" style="display: none;">
                    <i class="bi bi-backspace-fill"></i>
                </button>
            </div>
        </div>

        <!-- Tombol Submit -->
        <div class="col-12 col-md-auto">
            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </div>
</form>


                            <a href="{{ route('dashboard.members.create') }}" class="btn btn-success fw-semibold ms-2">
                                <i class="bi bi-person-plus-fill"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="table-responsive">
                        <table class="table" id="table">
                        <thead>
                            <tr class="fw-bold">
                                <td class="text-center">{{ __('No.') }}</td>
                                <td>{{ __('Nama') }}</td>
                                <td class="text-center">{{ __('Foto') }}</td>

                                @if (auth()->user()->role_id != 3)
                                    <td class="text-center">{{ __('PAC') }}</td>
                                @endif

                                <td class="text-center">
                                    {{ __('Makesta') }}
                                    <br />
                                    <small class="text-secondary fw-light">{{ __('(Formal)') }}</small>
                                </td>
                                <td class="text-center">
                                    {{ __('Lakmud') }}
                                    <br />
                                    <small class="text-secondary fw-light">{{ __('(Formal)') }}</small>
                                </td>
                                <td class="text-center">
                                    {{ __('Lakut') }}
                                    <br />
                                    <small class="text-secondary fw-light">{{ __('(Formal)') }}</small>
                                </td>
                                <td class="text-center">
                                    {{ __('Diklatama') }}
                                    <br />
                                    <small class="text-secondary fw-light">{{ __('(Non-Formal)') }}</small>
                                </td>
                                <td class="text-center">
                                    {{ __('Diklatnas') }}
                                    <br />
                                    <small class="text-secondary fw-light">{{ __('(Non-Formal)') }}</small>
                                </td>
                                <td class="text-center">
                                    {{ __('Diklatmad') }}
                                    <br />
                                    <small class="text-secondary fw-light">{{ __('(Non-Formal)') }}</small>
                                </td>
                                <td class="text-center">
                                    {{ __('Latinpel') }}
                                    <br />
                                    <small class="text-secondary fw-light">{{ __('(Non-Formal)') }}</small>
                                </td>
                                <td class="text-center">{{ __('Status Keanggotaan') }}</td>
                                <td class="text-center">{{ __('Aksi') }}</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $idx => $member)
                                <tr class="align-middle">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $member['name'] }}</td>
                                    <td class="text-center">
                                        @php
                                            $pacSlug = Str::slug($member->pac->pac); // jika ada relasi ke model PAC
                                        @endphp
                                        
                                        <a href="{{ asset($member['photo'] != 'default.png' 
                                            ? 'storage/images/members/' . $pacSlug . '/photo/' . $member['photo'] 
                                            : 'storage/images/default.png') }}">
                                            <img 
                                                src="{{ asset($member['photo'] != 'default.png' 
                                                    ? 'storage/images/members/' . $pacSlug . '/photo/' . $member['photo'] 
                                                    : 'storage/images/default.png') }}"
                                                width="60"
                                                class="img-fluid img-thumbnail"
                                                style="max-height: 60px"
                                                alt="{{ __('Foto Anggota') }}"
                                            />
                                        </a>
                                    </td>

                                    @if (auth()->user()->role_id != 3)
                                        <td class="text-center">
                                            {{ $member->pac->pac }}
                                        </td>
                                    @endif

                                    <td class="text-center">
                                        @if ($member['is_makesta'])
                                            <i class="bi bi-check text-success"></i>
                                            {{ __('Ya') }}
                                        @else
                                            <i class="bi bi-x text-danger"></i>
                                            {{ __('Tidak') }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($member['is_lakmud'])
                                            <i class="bi bi-check text-success"></i>
                                            {{ __('Ya') }}
                                        @else
                                            <i class="bi bi-x text-danger"></i>
                                            {{ __('Tidak') }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($member['is_lakut'])
                                            <i class="bi bi-check text-success"></i>
                                            {{ __('Ya') }}
                                        @else
                                            <i class="bi bi-x text-danger"></i>
                                            {{ __('Tidak') }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($member['is_diklatama'])
                                            <i class="bi bi-check text-success"></i>
                                            {{ __('Ya') }}
                                        @else
                                            <i class="bi bi-x text-danger"></i>
                                            {{ __('Tidak') }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($member['is_diklatnas'])
                                            <i class="bi bi-check text-success"></i>
                                            {{ __('Ya') }}
                                        @else
                                            <i class="bi bi-x text-danger"></i>
                                            {{ __('Tidak') }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($member['is_diklatmad'])
                                            <i class="bi bi-check text-success"></i>
                                            {{ __('Ya') }}
                                        @else
                                            <i class="bi bi-x text-danger"></i>
                                            {{ __('Tidak') }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($member['is_latinpel'])
                                            <i class="bi bi-check text-success"></i>
                                            {{ __('Ya') }}
                                        @else
                                            <i class="bi bi-x text-danger"></i>
                                            {{ __('Tidak') }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ 'Anggota ' . ($member['membership_status']->value == 'pac_member' ? __('PAC') : __('PC')) }}
                                    </td>
                                    <td class="btn-action text-center">
                                        <a
                                            href="{{ route('dashboard.members.show', $member) }}"
                                            class="btn btn-success btn-sm"
                                        >
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a
                                            href="{{ route('dashboard.members.edit', $member) }}"
                                            class="btn btn-warning btn-sm"
                                        >
                                            <i class="bi bi-pen-fill"></i>
                                        </a>
                                        <form
                                            action="{{ route('dashboard.members.destroy', $member) }}"
                                            method="POST"
                                            class="d-inline"
                                            id="delete-form"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm delete-btn">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>    
                </div>

                <div class="d-flex justify-content-center">
                    {{ $members->links() }}
                </div>
            </div>
        </div>

        <script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById("search-input");
        const clearBtn = document.getElementById("clear-search");

        // Tampilkan tombol clear jika ada teks
        function toggleClearButton() {
            clearBtn.style.display = searchInput.value.trim() !== "" ? "inline-block" : "none";
        }

        toggleClearButton();

        searchInput.addEventListener("input", toggleClearButton);

        clearBtn.addEventListener("click", function () {
            searchInput.value = "";
            toggleClearButton();
            searchInput.focus();
        });

        // Tombol hapus anggota
        document.querySelectorAll(".delete-btn").forEach((btn) => {
            btn.addEventListener("click", function (event) {
                Swal.fire({
                    title: "Apakah Anda yakin ingin menghapus anggota ini?",
                    icon: "warning",
                    showCancelButton: true,
                    cancelButtonText: "Batal",
                    confirmButtonText: "Ya",
                    reverseButtons: true,
                    customClass: {
                        cancelButton: "btn btn-secondary btn-lg",
                        confirmButton: "btn btn-success btn-lg",
                        actions: "swal-custom-actions",
                    },
                    buttonsStyling: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        btn.closest("form").submit();
                    }
                });
            });
        });
    });
</script>


    @endif
<style>
    @media (max-width: 768px) {
        .table thead {
            font-size: 0.75rem;
        }

        .table td,
        .table th {
            white-space: nowrap;
        }

        .table img {
            max-width: 100%;
            height: auto;
        }
        .search-input {
            width: 100%;
        }

        .btn-clear {
            z-index: 5;
        }
    }
</style>

@endsection