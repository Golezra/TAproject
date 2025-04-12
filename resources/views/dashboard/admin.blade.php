@extends('layouts.app')

@section('content')
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
            <div class="card user-info-card mb-3">
                <div class="card-body d-flex align-items-center">
                    <div class="user-profile me-3">
                        <img src="{{ asset('img/pict/' . Auth::user()->pict) }}" alt="User Profile Picture"
                            class="rounded-circle shadow" style="width: 80px; height: 80px; object-fit: cover;">
                    </div>
                    <div class="user-info">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-1">{{ Auth::user()->name }}</h5>
                            <span class="badge bg-warning ms-2 rounded-pill">Tim Operasional</span>
                        </div>
                        <p class="mb-0">{{ Auth::user()->rt ?? 'Tidak diketahui' }}</p>
                    </div>
                </div>
            </div>

            <!-- Cards Row -->
            <div class="row">
                <!-- Kartu: Pengguna -->
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-header">Pengguna</div>
                        <div class="card-body">
                            <h5 class="card-title">Total Pengguna</h5>
                            <p class="card-text">Kelola semua pengguna yang terdaftar.</p>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-light">Lihat Detail</a>
                        </div>
                    </div>
                </div>

                <!-- Kartu: Laporan -->
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-header">Laporan</div>
                        <div class="card-body">
                            <h5 class="card-title">Lihat Laporan</h5>
                            <p class="card-text">Akses laporan dan analitik sistem.</p>
                            <a href="{{ route('admin.reports.index') }}" class="btn btn-light">Lihat Detail</a>
                        </div>
                    </div>
                </div>

                <!-- Kartu: Manajemen Insentif -->
                <div class="col-md-4">
                    <div class="card text-white bg-info mb-3">
                        <div class="card-header">Manajemen Insentif</div>
                        <div class="card-body">
                            <h5 class="card-title">Laporan Insentif</h5>
                            <p class="card-text">Kelola insentif berdasarkan laporan warga.</p>
                            <a href="#" class="btn btn-light">Lihat Detail</a>
                        </div>
                    </div>
                </div>

                <!-- Kartu: Pengaturan -->
                <div class="col-md-4">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-header">Pengaturan</div>
                        <div class="card-body">
                            <h5 class="card-title">Pengaturan Sistem</h5>
                            <p class="card-text">Konfigurasi pengaturan aplikasi.</p>
                            <a href="{{ route('admin.validasi.index') }}" class="btn btn-light">Lihat Detail</a>
                        </div>
                    </div>
                </div>

                <!-- Kartu: Validasi Lapor Sampah -->
                <div class="col-md-4">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-header">Validasi Lapor Sampah</div>
                        <div class="card-body">
                            <h5 class="card-title">Validasi Laporan</h5>
                            <p class="card-text">Kelola dan validasi laporan sampah dari warga.</p>
                            <a href="{{ route('admin.validasi.index') }}" class="btn btn-light">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                
                <!-- Kartu: Notifikasi -->
                <div class="col-md-4">
                    <div class="card text-white bg-danger mb-3">
                        <div class="card-header">Notifikasi</div>
                        <div class="card-body">
                            <h5 class="card-title">Notifikasi Pengguna</h5>
                            <p class="card-text">Lihat dan kelola notifikasi pengguna.</p>
                            <a href="#" class="btn btn-light">Lihat Detail</a>
                        </div>
                    </div>
                </div>

                <!-- Kartu: Berita -->
                <div class="col-md-4">
                    <div class="card text-white bg-secondary mb-3">
                        <div class="card-header">Berita</div>
                        <div class="card-body">
                            <h5 class="card-title">Berita Terbaru</h5>
                            <p class="card-text">Tetap terupdate dengan berita dan pengumuman terbaru.</p>
                            {{-- <a href="{{ route('admin.news.index') }}" class="btn btn-light">Lihat Detail</a> --}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tombol Keluar Akun -->
            <form action="{{ route('sesi.logout') }}" method="POST">
                @csrf
                <div class="card user-info-card mb-3 px-3">
                    <button type="submit" class="card-body d-flex justify-content-between align-items-center border-0 bg-transparent">
                        <span class="text-danger fw-bold">Keluar Akun</span>
                        <i class="bi bi-box-arrow-right text-danger" style="font-size: 1.5rem;"></i>
                    </button>
                </div>
            </form>
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