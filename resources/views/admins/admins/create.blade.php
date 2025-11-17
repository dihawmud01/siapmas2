@extends('admins.layout')

@section('title', __('Tambah Admin'))

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg p-4">
        <h4 class="mb-4 text-success fw-bold">Tambah Admin</h4>
        <form action="{{ route('dashboard.admins.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Nama</label>
                    <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Bio</label>
                <textarea id="bio" name="bio" class="form-control" placeholder="Bio akan diisi otomatis berdasarkan role"></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Role</label>
                    <select id="role_id" name="role_id" class="form-select" required>
                        @foreach ($roles->whereIn('id', [1, 2, 3]) as $role)
                            <option value="{{ $role->id }}">{{ $role->role }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">PAC/Komisariat</label>
                    <select id="pac_id" name="pac_id" class="form-select">
                        <option value="">Pilih PAC</option>
                        @foreach ($pacList as $pac)
                            <option value="{{ $pac->id }}">{{ $pac->pac }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Password dengan Toggle Visibility -->
            <div class="mb-3 position-relative">
                <label class="form-label fw-semibold">Password</label>
                <div class="input-group">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                        <i class="bi bi-eye-slash"></i>
                    </button>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Foto</label>
                <input type="file" name="photo" class="form-control" accept=".jpg,.png" max-size="2048">
            </div>

            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('dashboard.admins.index') }}" class="btn btn-secondary btn-lg px-4">
                    <i class="bi bi-arrow-left"></i> Batal
                </a>
                <button type="submit" class="btn btn-success btn-lg px-4">
                    <i class="bi bi-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Script untuk Toggle Password Visibility -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const roleSelect = document.querySelector('select[name="role_id"]');
        const pacSelect = document.querySelector('select[name="pac_id"]');
        const bioInput = document.querySelector('textarea[name="bio"]');
        const passwordField = document.getElementById("password");
        const togglePassword = document.getElementById("togglePassword");
        
        function updateBioAndRole() {
            let selectedRoleId = parseInt(roleSelect.value);
            let selectedPAC = pacSelect.options[pacSelect.selectedIndex]?.text || "";

            if (selectedRoleId === 1) { // Super Admin
                bioInput.value = "Super Admin Account";
                pacSelect.value = "";
                pacSelect.disabled = true;
            } else if (selectedRoleId === 2) { // Admin PC
                bioInput.value = "Admin PC Account";
                pacSelect.value = "";
                pacSelect.disabled = true;
            } else if (selectedRoleId === 3) { // Admin PAC
                pacSelect.disabled = false;
                if (pacSelect.value) {
                    bioInput.value = `PAC ${selectedPAC} ACCOUNT`;
                }
            }
        }

        function handlePACChange() {
            if (pacSelect.value) {
                roleSelect.value = 3;
                updateBioAndRole();
            }
        }

        // Toggle Password Visibility
        togglePassword.addEventListener("click", function() {
            if (passwordField.type === "password") {
                passwordField.type = "text";
                togglePassword.innerHTML = '<i class="bi bi-eye"></i>';
            } else {
                passwordField.type = "password";
                togglePassword.innerHTML = '<i class="bi bi-eye-slash"></i>';
            }
        });

        updateBioAndRole();
        roleSelect.addEventListener("change", updateBioAndRole);
        pacSelect.addEventListener("change", handlePACChange);
    });
</script>

@endsection