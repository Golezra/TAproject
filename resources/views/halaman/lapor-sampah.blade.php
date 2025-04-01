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
                            <label class="form-label" for="lokasisampah">Lokasi Sampah</label>
                            <div class="d-flex flex-wrap gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="rt12" name="lokasisampah" value="RT 12" required>
                                    <label class="form-check-label" for="rt12">RT 12</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="rt13" name="lokasisampah" value="RT 13" required>
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
                            <label class="form-label" for="keteranganlokasisampah">Keterangan Lokasi Sampah</label>
                            <input class="form-control" id="keteranganlokasisampah" type="text" name="keteranganlokasisampah" placeholder="Rumah Bapak/Ibu..." required>
                        </div>

                        <!-- Jenis Sampah -->
                        <div class="form-group">
                            <label class="form-label" for="jenisSampah">Jenis Sampah</label>
                            <div class="d-flex flex-wrap gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="organik" name="jenisSampah" value="organik" required>
                                    <label class="form-check-label" for="organik">Organik</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="anorganik" name="jenisSampah" value="anorganik" required>
                                    <label class="form-check-label" for="anorganik">Anorganik</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="campuran" name="jenisSampah" value="campuran" required>
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
                            <label class="form-label" for="beratSampah">Berat Sampah</label>
                            <div class="input-group">
                                <input class="form-control" id="beratSampah" type="number" name="beratSampah" min="0" step="0.1" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">Kg</span>
                                </div>
                            </div>
                        </div>

                        <!-- Nominal -->
                        <div class="form-group">
                            <label class="form-label">Nominal yang Harus Dibayar</label>
                            <p id="nominalDisplay" class="text-success">Rp 0</p>
                        </div>

                        <!-- Foto Sampah -->
                        <div class="form-group">
                            <label class="form-label" for="fotoSampah">Foto Sampah</label>
                            <input class="form-control" id="fotoSampah" type="file" name="fotoSampah" accept="image/*" required>
                            <small class="text-muted" style="opacity: 0.6;">
                                Upload foto sampah yang jelas
                                <span style="color: red;">*</span>
                            </small>
                        </div>

                        <!-- Tanggal -->
                        <div class="form-group">
                            <label class="form-label" for="inputDate">Tanggal</label>
                            <input class="form-control" id="inputDate" type="date" name="date" required>
                        </div>

                        <!-- Submit Button -->
                        <button class="btn btn-primary w-100 d-flex align-items-center justify-content-center" type="submit">Laporkan
                            <i class="bi bi-arrow-right fz-16 ms-1"></i>
                        </button>
                    </form>

                    <script>
                        function validateForm() {
                            // Validasi Foto Sampah
                            const fotoSampah = document.getElementById('fotoSampah');
                            if (!fotoSampah.value) {
                                alert('Harap upload foto sampah.');
                                return false;
                            }

                            // Validasi Lokasi Sampah
                            const lokasiSampah = document.querySelectorAll('input[name="lokasisampah"]:checked');
                            if (lokasiSampah.length === 0) {
                                alert('Harap pilih salah satu lokasi sampah.');
                                return false;
                            }

                            // Validasi Jenis Sampah
                            const jenisSampah = document.querySelectorAll('input[name="jenisSampah"]:checked');
                            if (jenisSampah.length === 0) {
                                alert('Harap pilih salah satu jenis sampah.');
                                return false;
                            }

                            return true; // Jika semua validasi berhasil
                        }

                        // Event listener untuk menghitung nominal
                        function calculateNominal() {
                            const berat = parseFloat(document.getElementById('beratSampah').value) || 0;
                            const jenisSampah = Array.from(document.querySelectorAll('input[name="jenisSampah"]:checked'))
                                .map(radio => radio.value);

                            let nominal = 0;

                            if (jenisSampah.includes('organik')) {
                                nominal += berat * 5000;
                            }
                            if (jenisSampah.includes('anorganik')) {
                                nominal += berat * 10000;
                            }

                            document.getElementById('nominalDisplay').textContent = 'Rp ' + nominal.toLocaleString('id-ID');
                        }

                        document.getElementById('beratSampah').addEventListener('input', calculateNominal);
                        document.querySelectorAll('input[name="jenisSampah"]').forEach(radio => {
                            radio.addEventListener('change', calculateNominal);
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
