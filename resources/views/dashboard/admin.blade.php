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
                        <img src="{{ asset('img/pict/'.Auth::user()->pict) }}" alt="">
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

            <!-- Cards Row -->
            <div class="row">
                <!-- Card: Users -->
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-header">Users</div>
                        <div class="card-body">
                            <h5 class="card-title">Total Users</h5>
                            <p class="card-text">Manage all registered users.</p>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-light">View Details</a>
                        </div>
                    </div>
                </div>

                <!-- Card: Reports -->
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-header">Reports</div>
                        <div class="card-body">
                            <h5 class="card-title">View Reports</h5>
                            <p class="card-text">Access system reports and analytics.</p>
                            <a href="{{ route('admin.reports.index') }}" class="btn btn-light">View Details</a>
                        </div>
                    </div>
                </div>

                <!-- Card: Settings -->
                <div class="col-md-4">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-header">Settings</div>
                        <div class="card-body">
                            <h5 class="card-title">System Settings</h5>
                            <p class="card-text">Configure application settings.</p>
                            <a href="{{ route('admin.settings.index') }}" class="btn btn-light">View Details</a>
                        </div>
                    </div>
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