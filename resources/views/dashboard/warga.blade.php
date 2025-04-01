@extends('layouts.app')

@section('title', 'Warga')

@section('content')

<!-- Alert Success -->
@if(session('success'))
    <div class="toast toast-autohide custom-toast-1 toast-primary home-page-toast shadow" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="60000" data-bs-autohide="true" id="installWrap">
        <div class="toast-body p-4">
            <div class="toast-text me-2 d-flex align-items-center">
                <img src="{{ asset('img/core-img/bell.gif') }}" alt="Warning Icon" class="me-2" style="width: 50px; height: 50px;">
                <div>
                    <h6 class="text-warning mb-0">Wilujeng Sumping</h6>
                    {{ session('success') }}
                </div>
            </div>
            <button class="btn btn-close btn-close-white position-absolute p-2" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
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
                  <img src="{{ asset('img/pict/' . Auth::user()->pict) }}" 
                       alt="User Profile Picture" 
                       class="rounded-circle shadow" 
                       style="width: 80px; height: 80px; object-fit: cover; border: 2px solid #f8f9fa;">
              </div>
              <div class="user-info">
                  <h5 class="mb-1">{{ Auth::user()->name }}</h5>
                  <span class="badge bg-warning ms-2 rounded-pill">Warga</span>
              </div>
          </div>
          <!-- Tombol Isi Saldo dan Edit Profil -->
          <div class="d-flex justify-content-center gap-3 mt-1 mb-2">
              <a href="{{ route('isi-saldo') }}" class="btn btn-primary btn-sm">
                  Isi Saldo
              </a>
              <a href="{{ route('edit-profil') }}" class="btn btn-warning btn-sm">
                  Edit Profil
              </a>
          </div>
      </div>


      <!-- User Meta Data -->
      <div class="card user-data-card text-center">
          <div class="card-body">
              <h6 class="mb-3">Informasi Pengguna</h6>
              <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span>Username</span>
                      <span class="text-muted">{{ Auth::user()->username }}</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span>Nama Lengkap</span>
                      <span class="text-muted">{{ Auth::user()->name }}</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span>Email</span>
                      <span class="text-muted">{{ Auth::user()->email }}</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span>Role</span>
                      <span class="text-muted">Warga</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span>Alamat</span>
                      <span class="text-muted">{{ Auth::user()->rt }}</span>
                  </li>
              </ul>
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