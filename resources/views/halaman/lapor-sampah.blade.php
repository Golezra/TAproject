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
                    <form action="{{ route('lapor-sampah.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="lokasisampah">Lokasi Sampah</label>
                            <select class="form-select" id="lokasisampah" name="lokasisampah" aria-label="Pilih RT">
                                <option value="" selected>Pilih RT</option>
                                <option value="RT 12">RT 12</option>
                                <option value="RT 13">RT 13</option>
                            </select>
                            <small class="text-muted" style="opacity: 0.6;">
                                Pilih RT 12 atau RT 13
                                <span style="color: red;">*</span>
                            </small>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="keteranganlokasisampah">Keterangan Lokasi Sampah</label>
                            <input class="form-control" id="keteranganlokasisampah" type="text"
                                name="keteranganlokasisampah" placeholder="Rumah Bapak/Ibu..." required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="jenisSampah">Jenis Sampah</label>
                            <select class="form-select" id="jenisSampah" name="jenisSampah"
                                aria-label="Pilih jenis sampah">
                                <option value="" selected>Pilih jenis sampah</option>
                                <option value="organik">Organik</option>
                                <option value="anorganik">Anorganik</option>
                            </select>
                            <small class="text-muted" style="opacity: 0.6;">
                                Pilih jenis sampah Organik atau Anorganik
                                <span style="color: red;">*</span>
                            </small>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="beratSampah">Berat Sampah</label>
                            <div class="input-group">
                                <input class="form-control" id="beratSampah" type="number" name="beratSampah"
                                    min="0" step="0.1" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">Kg</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Nominal yang Harus Dibayar</label>
                            <p id="nominalDisplay" class="text-success">Rp 0</p>
                        </div>

                        <script>
                            document.getElementById('beratSampah').addEventListener('input', function() {
                                const berat = parseFloat(this.value) || 0;
                                const jenisSampah = document.getElementById('jenisSampah').value;
                                let nominal = 0;

                                if (jenisSampah === 'organik') {
                                    nominal = berat * 5000;
                                } else if (jenisSampah === 'anorganik') {
                                    nominal = berat * 10000;
                                }

                                document.getElementById('nominalDisplay').textContent = 'Rp ' + nominal.toLocaleString('id-ID');
                            });

                            document.getElementById('jenisSampah').addEventListener('change', function() {
                                const berat = parseFloat(document.getElementById('beratSampah').value) || 0;
                                const jenisSampah = this.value;
                                let nominal = 0;

                                if (jenisSampah === 'organik') {
                                    nominal = berat * 5000;
                                } else if (jenisSampah === 'anorganik') {
                                    nominal = berat * 10000;
                                }

                                document.getElementById('nominalDisplay').textContent = 'Rp ' + nominal.toLocaleString('id-ID');
                            });
                        </script>

                        <div class="form-group">
                            <label class="form-label" for="fotoSampah">Foto Sampah</label>
                            <input class="form-control" id="fotoSampah" type="file" name="fotoSampah"
                                accept="image/*" required>
                            <small class="text-muted" style="opacity: 0.6;">
                                Upload foto sampah yang jelas
                                <span style="color: red;">*</span>
                            </small>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="inputDate">Tanggal</label>
                            <input class="form-control" id="inputDate" type="date" name="date">
                        </div>

                        <button class="btn btn-primary w-100 d-flex align-items-center justify-content-center"
                            type="submit">Laporkan
                            <i class="bi bi-arrow-right fz-16 ms-1"></i>
                        </button>
                    </form>
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
