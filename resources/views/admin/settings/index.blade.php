@extends('layouts.app')

@section('title', 'Admin Settings')

@section('content')
<div class="container py-5">
    <h1>Admin Settings</h1>
    <p>Halaman ini berisi pengaturan sistem.</p>

    <!-- Contoh tambahan pengaturan -->
    <div class="settings-section mt-4">
        <h2>Pengaturan Umum</h2>
        <form action="#" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="site_name" class="form-label">Nama Situs</label>
                <input type="text" class="form-control" id="site_name" name="site_name" value="{{ old('site_name', $settings->site_name ?? '') }}">
            </div>
            <div class="mb-3">
                <label for="site_email" class="form-label">Email Situs</label>
                <input type="email" class="form-control" id="site_email" name="site_email" value="{{ old('site_email', $settings->site_email ?? '') }}">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <!-- Pengaturan Tambahan -->
    <div class="settings-section mt-5">
        <h2>Pengaturan Keamanan</h2>
        <form action="#" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="password_policy" class="form-label">Kebijakan Kata Sandi</label>
                <select class="form-select" id="password_policy" name="password_policy">
                    <option value="weak" {{ old('password_policy', $settings->password_policy ?? '') == 'weak' ? 'selected' : '' }}>Lemah</option>
                    <option value="medium" {{ old('password_policy', $settings->password_policy ?? '') == 'medium' ? 'selected' : '' }}>Sedang</option>
                    <option value="strong" {{ old('password_policy', $settings->password_policy ?? '') == 'strong' ? 'selected' : '' }}>Kuat</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <div class="settings-section mt-5">
        <h2>Pengaturan Notifikasi</h2>
        <form action="#" method="POST">
            @csrf
            @method('PUT')
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="email_notifications" name="email_notifications" {{ old('email_notifications', $settings->email_notifications ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="email_notifications">
                    Aktifkan Notifikasi Email
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="sms_notifications" name="sms_notifications" {{ old('sms_notifications', $settings->sms_notifications ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="sms_notifications">
                    Aktifkan Notifikasi SMS
                </label>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>
</div>
@endsection