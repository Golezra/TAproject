@extends('layouts.app')

@section('title', 'Lapor Sampah')

@push('scripts')
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"></script>
    <script src="js/maps.js"></script>
@endpush

@section('content')

    @include('components.alert')

    <!-- Dark mode switching -->
    <div class="dark-mode-switching">
        <div class="d-flex w-100 h-100 align-items-center justify-content-center">
            <div class="dark-mode-text text-center">
                <i class="bi bi-moon"></i>
                <p class="mb-0">Switching to dark mode</p>
            </div>
            <div class="light-mode-text text-center">
                <i class="bi bi-brightness-high"></i>
                <p class="mb-0">Switching to light mode</p>
            </div>
        </div>
    </div>

    <!-- RTL mode switching -->
    <div class="rtl-mode-switching">
        <div class="d-flex w-100 h-100 align-items-center justify-content-center">
            <div class="rtl-mode-text text-center">
                <i class="bi bi-text-right"></i>
                <p class="mb-0">Switching to RTL mode</p>
            </div>
            <div class="ltr-mode-text text-center">
                <i class="bi bi-text-left"></i>
                <p class="mb-0">Switching to default mode</p>
            </div>
        </div>
    </div>

    <!-- Setting Popup Overlay -->
    <div id="setting-popup-overlay"></div>

    <!-- Setting Popup Card -->
    <div class="card setting-popup-card shadow-lg" id="settingCard">
        <div class="card-body">
            <div class="container">
                <div class="setting-heading d-flex align-items-center justify-content-between mb-3">
                    <p class="mb-0">Settings</p>
                    <div class="btn-close" id="settingCardClose"></div>
                </div>

                <div class="single-setting-panel">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="availabilityStatus" checked>
                        <label class="form-check-label" for="availabilityStatus">Availability status</label>
                    </div>
                </div>

                <div class="single-setting-panel">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="sendMeNotifications" checked>
                        <label class="form-check-label" for="sendMeNotifications">Send me notifications</label>
                    </div>
                </div>

                <div class="single-setting-panel">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="darkSwitch">
                        <label class="form-check-label" for="darkSwitch">Dark mode</label>
                    </div>
                </div>

                <div class="single-setting-panel">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="rtlSwitch">
                        <label class="form-check-label" for="rtlSwitch">RTL mode</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Area -->
    <div class="header-area" id="headerArea">
        <div class="container">
            <!-- Header Content -->
            <div class="header-content position-relative d-flex align-items-center justify-content-between">
                <!-- Back Button -->
                <div class="back-button">
                    <a href="{{ asset('/home') }}">
                        <i class="bi bi-arrow-left-short"></i>
                    </a>
                </div>

                <!-- Page Title -->
                <div class="page-heading">
                    <h6 class="mb-0">Melaporkan Sampah</h6>
                </div>

                <!-- Settings -->
                <div class="setting-wrapper">
                    <div class="setting-trigger-btn" id="settingTriggerBtn">
                        <i class="bi bi-gear"></i>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content-wrapper py-3">
        <!-- Element Heading -->
        <div class="container">
            <div class="element-heading">
                <h6>Isi Form Laporan Sampah</h6>
            </div>
        </div>

        <div class="container">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('lapor-sampah.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                        @csrf

                        <!-- Lokasi Sampah -->
                        <div class="form-group">
                            <label class="form-label" for="lokasi_sampah">Lokasi Sampah</label>
                            <div class="d-flex flex-wrap gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="rt12" name="lokasi_sampah" value="RT 12" required>
                                    <label class="form-check-label" for="rt12">RT 12</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="rt13" name="lokasi_sampah" value="RT 13" required>
                                    <label class="form-check-label" for="rt13">RT 13</label>
                                </div>
                            </div>
                            <small class="text-muted" style="opacity: 0.6;">
                                Pilih salah satu lokasi sampah yang sesuai
                                <span style="color: red;">*</span>
                            </small>
                        </div>

                        <!-- Keterangan Lokasi Sampah -->
                        <div class="form-group">
                            <label class="form-label" for="keterangan_lokasi_sampah">Keterangan Lokasi Sampah</label>
                            <input class="form-control" id="keterangan_lokasi_sampah" type="text" name="keterangan_lokasi_sampah" placeholder="Rumah Bapak/Ibu..." required>
                        </div>

                        <!-- Jenis Sampah -->
                        <div class="form-group">
                            <label class="form-label" for="jenis_sampah">Jenis Sampah</label>
                            <div class="d-flex flex-wrap gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="organik" name="jenis_sampah" value="organik" required>
                                    <label class="form-check-label" for="organik">Organik</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="anorganik" name="jenis_sampah" value="anorganik" required>
                                    <label class="form-check-label" for="anorganik">Anorganik</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="campuran" name="jenis_sampah" value="campuran" required>
                                    <label class="form-check-label" for="campuran">Campuran</label>
                                </div>
                            </div>
                            <small class="text-muted" style="opacity: 0.6;">
                                Pilih salah satu jenis sampah yang sesuai
                                <span style="color: red;">*</span>
                            </small>
                        </div>

                        <!-- Berat Sampah -->
                        <div class="form-group">
                            <label class="form-label" for="berat_sampah">Berat Sampah</label>
                            <div class="input-group">
                                <input class="form-control" id="berat_sampah" type="number" name="berat_sampah" min="0" step="0.1" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">Kg</span>
                                </div>
                            </div>
                        </div>

                        <!-- Nominal yang Harus Dibayar-->
                        <div class="form-group">
                            <label class="form-label">Nominal yang Harus Dibayar</label>
                            <p id="nominalDisplay" class="text-success">Rp 0</p>
                            <small class="text-muted" style="opacity: 0.6;">
                                Nominal akan dihitung berdasarkan jenis dan berat sampah
                                <span style="color: red;">*</span>
                            </small>
                        </div>

                        <!-- Foto Sampah -->
                        <div class="form-group">
                            <label class="form-label" for="foto_sampah">Foto Sampah</label>
                            <input class="form-control" id="foto_sampah" type="file" name="foto_sampah" accept="image/*" required>
                            <small class="text-muted" style="opacity: 0.6;">
                                Upload foto sampah yang jelas
                                <span style="color: red;">*</span>
                            </small>
                        </div>

                        <!-- Submit Button -->
                        <button class="btn btn-primary w-100 d-flex align-items-center justify-content-center" type="submit">Laporkan
                            <i class="bi bi-arrow-right fz-16 ms-1"></i>
                        </button>
                    </form>

                    <script>
                        function validateForm() {
                            // Validasi Foto Sampah
                            const foto_sampah = document.getElementById('foto_sampah');
                            if (!foto_sampah.value) {
                                alert('Harap upload foto sampah.');
                                return false;
                            }

                            // Validasi Lokasi Sampah
                            const lokasi_sampah = document.querySelectorAll('input[name="lokasi_sampah"]:checked');
                            if (lokasi_sampah.length === 0) {
                                alert('Harap pilih salah satu lokasi sampah.');
                                return false;
                            }

                            // Validasi Jenis Sampah
                            const jenis_sampah = document.querySelectorAll('input[name="jenis_sampah"]:checked');
                            if (jenis_sampah.length === 0) {
                                alert('Harap pilih salah satu jenis sampah.');
                                return false;
                            }

                            return true; // Jika semua validasi berhasil
                        }

                        // Event listener untuk menghitung nominal
                        function calculateNominal() {
                            const berat = parseFloat(document.getElementById('berat_sampah').value) || 0;
                            const jenis_sampah = Array.from(document.querySelectorAll('input[name="jenis_sampah"]:checked'))
                                .map(radio => radio.value);

                            let nominal = 0;

                            if (jenis_sampah.includes('organik')) {
                                nominal += berat * 5000;
                            }
                            if (jenis_sampah.includes('anorganik')) {
                                nominal += berat * 2500;
                            }
                            if (jenis_sampah.includes('campuran')) {
                                nominal += berat * 10000; // Misalnya, campuran dihargai Rp 4000 per kg
                            }

                            document.getElementById('nominalDisplay').textContent = 'Rp ' + nominal.toLocaleString('id-ID');
                        }

                        document.getElementById('berat_sampah').addEventListener('input', calculateNominal);
                        document.querySelectorAll('input[name="jenis_sampah"]').forEach(radio => {
                            radio.addEventListener('change', calculateNominal);
                        });

                        document.addEventListener('DOMContentLoaded', function () {
                            const jenis_sampahInputs = document.querySelectorAll('input[name="jenis_sampah"]');
                            const berat_sampahInput = document.getElementById('berat_sampah');
                            const simulasiBiaya = document.getElementById('simulasiBiaya');

                            function hitungBiaya() {
                                const jenis_sampah = document.querySelector('input[name="jenis_sampah"]:checked');
                                const berat_sampah = parseFloat(beratSampahInput.value);

                                if (jenis_sampah && !isNaN(berat_sampah)) {
                                    let biayaPerKg = 0;

                                    // Tentukan biaya per kg berdasarkan jenis sampah
                                    if (jenis_sampah.value === 'organik') {
                                        biayaPerKg = 5000;
                                    } else if (jenis_sampah.value === 'anorganik') {
                                        biayaPerKg = 2500;
                                    }

                                    // Hitung total biaya
                                    const totalBiaya = biayaPerKg * berat_sampah;

                                    // Tampilkan hasil
                                    simulasiBiaya.textContent = `Total biaya: Rp ${totalBiaya.toLocaleString('id-ID')}`;
                                } else {
                                    simulasiBiaya.textContent = 'Masukkan jenis sampah dan berat untuk melihat biaya.';
                                }
                            }

                            // Tambahkan event listener
                            jenis_sampahInputs.forEach(input => {
                                input.addEventListener('change', hitungBiaya);
                            });
                            berat_sampahInput.addEventListener('input', hitungBiaya);
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Nav -->
    <div class="footer-nav-area" id="footerNav">
        <div class="container px-0">
            <!-- Footer Content -->
            @include('components.footer')
        </div>
    </div>
@endsection
