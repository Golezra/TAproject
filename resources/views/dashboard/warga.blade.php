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
      <!-- User Information-->
      <div class="card user-info-card mb-3">
        <div class="card-body d-flex align-items-center">
          <div class="user-profile me-3">
            <img src="{{ asset('img/pict/'.Auth::user()->pict) }}" alt="">
            <i class="bi bi-pencil"></i>
            <form action="#">
              <input class="form-control" type="file">
            </form>
          </div>
          <div class="user-info">
            <div class="d-flex align-items-center">
              <h5 class="mb-1">{{ Auth::user()->name }}</h5>
              <span class="badge bg-warning ms-2 rounded-pill">Pro</span>
            </div>
            <p class="mb-0">{{ Auth::user()->role }}</p>
          </div>
        </div>
      </div>

      <!-- User Meta Data-->
      <div class="card user-data-card">
        <div class="card-body">
          <form action="#">
            <div class="form-group mb-3">
              <label class="form-label" for="Username">Username</label>
              <input class="form-control" id="Username" type="text" value="{{ Auth::user()->username }}" placeholder="Username"
                readonly>
            </div>

            <div class="form-group mb-3">
              <label class="form-label" for="fullname">Full Name</label>
              <input class="form-control" id="fullname" type="text" value="{{ Auth::user()->name }}" placeholder="Full Name"
                readonly>
            </div>

            <div class="form-group mb-3">
              <label class="form-label" for="email">Email Address</label>
              <input class="form-control" id="email" type="text" value="{{ Auth::user()->email }}" placeholder="Email Address"
                readonly>
            </div>

            <div class="form-group mb-3">
              <label class="form-label" for="job">Job Title</label>
              <input class="form-control" id="job" type="text" value="{{ Auth::user()->role }}" placeholder="Job Title">
            </div>

            <div class="form-group mb-3">
              <label class="form-label" for="portfolio">Portfolio URL</label>
              <input class="form-control" id="portfolio" type="url" value="https://themeforest.net/user/designing-world"
                placeholder="Portfolio URL">
            </div>

            <div class="form-group mb-3">
              <label class="form-label" for="address">Address</label>
              <input class="form-control" id="address" type="text" value="{{ Auth::user()->rt }}" placeholder="Address">
            </div>

            <div class="form-group mb-3">
              <label class="form-label" for="bio">Bio</label>
              <textarea class="form-control" id="bio" name="bio" cols="30" rows="10"
                placeholder="Working as UX/UI Designer at Designing World since 2016."></textarea>
            </div>

            <button class="btn btn-success w-100" type="submit">Update Now</button>
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