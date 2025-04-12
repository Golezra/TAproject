@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

<!-- Back Button -->
<div class="login-back-button">
    <a href="{{ route('admin.users.index') }}">
        <i class="bi bi-arrow-left-short"></i>
    </a>
</div>

<div class="page-content-wrapper py-3">
    <div class="container">
        <div class="card user-info-card mb-3">
            <div class="card-body">
                <h1 class="card-title">Edit User</h1>
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" placeholder="Masukkan Nama Lengkap Anda" required>
                        <small id="nameAlert" class="text-danger d-none">Nama lengkap tidak boleh mengandung angka atau simbol seperti !@#$%^&*(),.<>/?=+-_</small>
                    </div>
                    
                    <!-- Foto Profil -->
                    <div class="form-group">
                        <label for="pict">Profile Picture</label>
                        <input type="file" name="pict" id="pict" class="form-control">
                        @if($user->pict)
                            <img src="{{ asset('img/pict/' . $user->pict) }}" alt="Foto Profil" class="img-thumbnail mt-2" style="max-width: 150px;">
                        @endif
                    </div>
                    
                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Saat Ini</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <!-- Role -->
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="tim_operasional" {{ $user->role == 'tim_operasional' ? 'selected' : '' }}>Tim Operasional</option>
                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                        </select>
                    </div>
            
                    <!-- RT -->
                    <div class="mb-3">
                        <label for="rt" class="form-label">RT</label>
                        <select name="rt" id="rt" class="form-control" required>
                            <option value="12" {{ $user->rt == '12' ? 'selected' : '' }}>RT 12</option>
                            <option value="13" {{ $user->rt == '13' ? 'selected' : '' }}>RT 13</option>
                        </select>
                    </div>
                    
                    <!-- No. Telepon -->
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">No. Telepon</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $user->phone_number }}" placeholder="Masukkan No. Telepon Anda" required>
                        <small id="phoneAlert" class="text-danger d-none">Nomor telepon harus dimulai dengan 0, memiliki panjang antara 8-15 karakter, dan hanya berisi digit.</small>
                    </div>
                    
                    <!-- NIK -->
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" name="nik" id="nik" class="form-control" value="{{ $user->nik }}" placeholder="Masukkan NIK Anda" required>
                        <small id="nikAlert" class="text-danger d-none">NIK harus terdiri dari 16 digit.</small>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('pict').addEventListener('click', function () {
            console.log('Input file dipicu');
        });

        const pictInput = document.getElementById('pict');
        const profileImage = document.querySelector('img[alt="Foto Profil"]');

        pictInput.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    profileImage.src = e.target.result; // Ganti src gambar dengan file yang diunggah
                };
                reader.readAsDataURL(file); // Membaca file sebagai URL data
            }
        });
</script>
    
@endsection