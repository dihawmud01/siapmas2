@extends('admins.layout')

@section('title', __('Edit Admin'))

@section('content')
<div class="container mt-4">
    <div class="card shadow p-4">
        <h4 class="mb-4">Edit Admin</h4>

        <form action="{{ route('dashboard.admins.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <!-- Foto Profil -->
                <div class="col-md-4 text-center">
                    <label for="photo" class="form-label">Foto Profil</label>
                    <div class="mb-3">
                        <a href="{{ asset($user->photo != 'default.png' 
                            ? 'storage/images/user/photos/' . $user->id . '/' . $user->photo 
                            : 'storage/images/default.png') }}" id="photo-link">

                            <img src="{{ asset($user->photo != 'default.png' 
                                ? 'storage/images/user/photos/' . $user->id . '/' . $user->photo 
                                : 'storage/images/default.png') }}" 
                                class="rounded-circle img-thumbnail" width="150" style="max-height: 150px;"
                                id="photo-preview"
                                alt="{{ __('Foto Admin') }}">
                        </a>
                    </div>
                    
                    <input type="file" class="form-control" id="photo" name="photo" accept="image/*" onchange="previewPhoto(event)">
                    <small class="text-muted">Maksimal 2MB, format: JPG, PNG, GIF</small>
                </div>

                <!-- Form Edit Data -->
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Pilih Role -->
                    <div class="mb-3">
                        <label for="role_id" class="form-label">Role</label>
                        <select class="form-control @error('role_id') is-invalid @enderror" id="role_id" name="role_id" required onchange="updateBioAndPAC()">
                            <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>Super Admin</option>
                            <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>Admin PC</option>
                            <option value="3" {{ $user->role_id == 3 ? 'selected' : '' }}>Admin PAC</option>
                        </select>
                        @error('role_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Pilih PAC (hanya muncul jika memilih Admin PAC) -->
                    <div class="mb-3" id="pac_section" style="display: none;">
                        <label for="pac_id" class="form-label">PAC/Komisariat</label>
                        <select class="form-control @error('pac_id') is-invalid @enderror" id="pac_id" name="pac_id">
                            <option value="">-- Pilih PAC --</option>
                            @foreach($pacList as $pac)
                                <option value="{{ $pac->id }}" {{ $user->pac_id == $pac->id ? 'selected' : '' }}>{{ $pac->pac }}</option>
                            @endforeach
                        </select>
                        @error('pac_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="3">{{ old('bio', $user->bio) }}</textarea>
                        @error('bio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Edit Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru (Opsional)</label>
                        <div class="input-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">
                            <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                        <small class="text-muted">Minimal 6 karakter. Kosongkan jika tidak ingin mengganti password.</small>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <!-- Tombol Aksi -->
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('dashboard.admins.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Script untuk Preview Foto -->
<script>
function previewPhoto(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('photo-preview');
        output.src = reader.result;
        document.getElementById('photo-link').href = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}

// Tampilkan PAC hanya jika role adalah Admin PAC
    function updateBioAndPAC() {
        var role = document.getElementById("role_id").value;
        var pacSection = document.getElementById("pac_section");
        var bioInput = document.getElementById("bio");
        var pacSelect = document.getElementById("pac_id");

        if (role == 3) { 
            pacSection.style.display = "block"; 
            var pacText = pacSelect.options[pacSelect.selectedIndex].text || "";
            bioInput.value = "Admin PAC " + pacText + " account";
        } else {
            pacSection.style.display = "none"; 
            pacSelect.selectedIndex = 0; 
            if (role == 1) {
                bioInput.value = "Super Admin Account";
            } else if (role == 2) {
                bioInput.value = "Admin PC Account";
            } else {
                bioInput.value = "";
            }
        }
    }

    // Panggil fungsi pertama kali untuk menyesuaikan UI berdasarkan data yang ada
    document.addEventListener("DOMContentLoaded", function() {
        updateBioAndPAC();
        document.getElementById("pac_id").addEventListener("change", updateBioAndPAC);
    });
</script>

@endsection
