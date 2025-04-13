@extends('layouts.app')

@section('title', 'Warga')

@section('content')

    <!-- Alert Success -->
    @if (session('success'))
        <div class="alert custom-alert-two alert-primary alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i>
            {{ session('success') }}
            <button class="btn btn-close btn-close-white position-relative p-1 ms-auto" type="button" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif

    <!-- Notifikasi -->
    @if (session('notifications'))
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">Notifikasi</div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach (session('notifications') as $notification)
                        <li class="list-group-item">
                            {{ $notification->message }}
                            <span class="text-muted d-block"
                                style="font-size: 0.8rem;">{{ $notification->created_at->diffForHumans() }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Header Area -->
    <div class="header-area" id="headerArea">
        @include('components.header-menu')
    </div>

    <!-- # Sidenav Left -->
    <div class="offcanvas offcanvas-start" id="affanOffcanvas" data-bs-scroll="true" tabindex="-1"
        aria-labelledby="affanOffcanvsLabel">
        @include('components.sidenav-leaft')
    </div>

    <div class="page-content-wrapper py-3">
        <div class="container">
            <!-- User Information -->
            <div class="card user-info-card mb-3 text-center">
                <div class="card-body d-flex flex-column align-items-center">
                    <div class="user-profile mb-3">
                        <img src="{{ asset('img/pict/' . Auth::user()->pict) }}" alt="User Profile Picture"
                            class="rounded-circle shadow"
                            style="width: 80px; height: 80px; object-fit: cover; border: 2px solid #f8f9fa; cursor: pointer;"
                            data-bs-toggle="modal" data-bs-target="#profilePictureModal">
                    </div>
                    <div class="user-info">
                        <h5 class="mb-1">{{ Auth::user()->name }}</h5>
                        <span class="badge bg-warning ms-2 rounded-pill">Warga</span>
                    </div>
                </div>
                <hr class="my-2">
                <!-- Informasi Jumlah Saldo dan Jumlah Lapor -->
                <div class="d-flex justify-content-center align-items-center gap-3 mt-1 mb-2">
                    <div class="d-flex justify-content-center w-100 gap-5">
                        <div class="text-primary text-center" style="font-size: 0.9rem;">
                            Jumlah Lapor: {{ Auth::user()->jumlah_lapor }}
                        </div>
                        <div class="text-success text-center" style="font-size: 0.9rem;">
                           Jumlah Poin: {{ number_format(Auth::user()->poin, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Pilihan Menu -->
            <div class="card user-info-card mb-3 px-3">
                <div class="card-body text-start">
                    <h6 class="card-title mb-3">Pilihan Menu</h6>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('warga.edit-profil') }}"
                            class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="bi bi-person-circle me-2"></i> Edit Profil
                            <i class="bi bi-chevron-right shadow ms-auto"></i>
                        </a>
                        <a href="{{ route('riwayat-lapor') }}"
                            class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="bi bi-clock-history me-2"></i> Riwayat Lapor
                            <i class="bi bi-chevron-right shadow ms-auto"></i>
                        </a>
                        <a href="{{ route('halaman.coming-soon') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="bi bi-cash-coin me-2"></i> Pembayaran
                            <i class="bi bi-chevron-right shadow ms-auto"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card Bantuan -->
            <div class="card user-info-card mb-3 px-3">
                <div class="card-body text-start">
                    <h6 class="card-title mb-3">Bantuan</h6>
                    <div class="list-group list-group-flush">
                        <a href="https://wa.me/6285797879723" target="_blank"
                            class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="bi bi-whatsapp me-2 text-success"></i> Hubungi Kami di WhatsApp
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tombol Keluar Akun -->
            <form action="{{ route('sesi.logout') }}" method="POST">
                @csrf
                <div class="card user-info-card bg-success mb-3 px-3">
                    <button type="submit"
                        class="card-body d-flex justify-content-between align-items-center border-0 bg-transparent">
                        <span class="text-white fw-bold">Keluar Akun</span>
                        <i class="bi bi-escape text-white" style="font-size: 1.5rem;"></i>
                    </button>
                </div>
            </form>
            <!-- Card Kritik dan Saran -->
            <div class="card user-info-card mb-3 px-3">
                <div class="card-body text-start">
                    <h6 class="card-title mb-3">Kritik dan Saran</h6>
                    <div class="list-group list-group-flush">
                        <a href="#"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            Berikan masukan untuk perbaikan aplikasi Sireum Hideung
                            <i class="bi bi-chevron-right shadow"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk Foto Profil -->
        <div class="modal fade" id="profilePictureModal" tabindex="-1" aria-labelledby="profilePictureModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="profilePictureModalLabel">Foto Profil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ asset('img/pict/' . Auth::user()->pict) }}" alt="User Profile Picture"
                            id="zoomableProfilePicture" class="img-fluid rounded-circle shadow"
                            style="max-width: 100%; cursor: zoom-in;">
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const profilePicture = document.getElementById('zoomableProfilePicture');
                let scale = 1;

                profilePicture.addEventListener('wheel', function(event) {
                    event.preventDefault();
                    if (event.deltaY < 0) {
                        // Zoom in
                        scale += 0.1;
                    } else {
                        // Zoom out
                        scale = Math.max(1, scale - 0.1); // Jangan lebih kecil dari skala 1
                    }
                    profilePicture.style.transform = `scale(${scale})`;
                });
            });
        </script>

        <!-- Footer Nav -->
        <div class="footer-nav-area" id="footerNav">
            <div class="container px-0">
                <!-- Footer Content -->
                @include('components.footer')
            </div>
        </div>

    @endsection
