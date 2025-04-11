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
                <!-- Card: Laporan Menunggu Diangkut -->
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-header">Menunggu Diangkut</div>
                        <div class="card-body">
                            <h5 class="card-title">Total Laporan</h5>
                            <p class="card-text">Lihat laporan yang perlu diangkut.</p>
                            <a href="{{ route('tim-operasional.laporan.menunggu') }}" class="btn btn-light">Lihat Details</a>
                        </div>
                    </div>
                </div>

                <!-- Card: Laporan Sudah Diangkut -->
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-header">Sudah Diangkut</div>
                        <div class="card-body">
                            <h5 class="card-title">Total Laporan</h5>
                            <p class="card-text">Lihat laporan yang sudah diangkut.</p>
                            <a href="{{ route('tim-operasional.laporan.diangkut') }}" class="btn btn-light">Lihat Details</a>
                        </div>
                    </div>
                </div>
                <!-- Card:-->
                <div class="col-md-4">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-header">Lorem ipsum dolor</div>
                        <div class="card-body">
                            <h5 class="card-title">Total Laporan</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            <a href="#" class="btn btn-light">Lihat Details</a>
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