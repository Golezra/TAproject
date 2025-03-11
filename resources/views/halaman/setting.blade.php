@extends('layouts.app')

@section('title', 'Setting')

@section('content')

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

  <!-- Header Area-->
  <div class="header-area" id="headerArea">
    <div class="container">
      <!-- Header Content-->
      <div class="header-content header-style-four position-relative d-flex align-items-center justify-content-between">
        <!-- Back Button-->
        <div class="back-button">
          <a href="{{asset('home')}}">
            <i class="bi bi-arrow-left-short"></i>
          </a>
        </div>

        <!-- Page Title-->
        <div class="page-heading">
          <h6 class="mb-0">Settings</h6>
        </div>

        <!-- User Profile-->
        <div class="user-profile-wrapper">
          <a class="user-profile-trigger-btn" href="#">
          <img src="{{ asset('img/pict/'.Auth::user()->pict) }}" alt="">
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="page-content-wrapper py-3">
    <div class="container">
      <!-- Setting Card-->
      <div class="card mb-3 shadow-sm">
        <div class="card-body direction-rtl">
          <p class="mb-2">Settings</p>

          <div class="single-setting-panel">
            <div class="form-check form-switch mb-2">
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked>
              <label class="form-check-label" for="flexSwitchCheckDefault">Availability Status</label>
            </div>
          </div>

          <div class="single-setting-panel">
            <div class="form-check form-switch mb-2">
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault2" checked>
              <label class="form-check-label" for="flexSwitchCheckDefault2">Send Me Notifications</label>
            </div>
          </div>

          <div class="single-setting-panel">
            <div class="form-check form-switch mb-2">
              <input class="form-check-input" type="checkbox" id="darkSwitch">
              <label class="form-check-label" for="darkSwitch">Dark Mode</label>
            </div>
          </div>

          <div class="single-setting-panel">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="rtlSwitch">
              <label class="form-check-label" for="rtlSwitch">RTL Mode</label>
            </div>
          </div>
        </div>
      </div>

      <!-- Setting Card-->
      <div class="card mb-3 shadow-sm">
        <div class="card-body direction-rtl">
          <p class="mb-2">Account Setup</p>

          <div class="single-setting-panel">
            <a href="user-profile.html">
              <div class="icon-wrapper">
                <i class="bi bi-person"></i>
              </div>
              Update Profile
            </a>
          </div>

          <div class="single-setting-panel">
            <a href="user-profile.html">
              <div class="icon-wrapper bg-warning">
                <i class="bi bi-pencil"></i>
              </div>
              Update Bio
            </a>
          </div>

          <div class="single-setting-panel">
            <a href="{{route('sesi.change-password')}}">
              <div class="icon-wrapper bg-info">
                <i class="bi bi-lock"></i>
              </div>
              Change Password
            </a>
          </div>

          <div class="single-setting-panel">
            <a href="language.html">
              <div class="icon-wrapper bg-success">
                <i class="bi bi-globe2"></i>
              </div>
              Language
            </a>
          </div>

          <div class="single-setting-panel">
            <a href="privacy-policy.html">
              <div class="icon-wrapper bg-danger">
                <i class="bi bi-shield-lock"></i>
              </div>
              Privacy Policy
            </a>
          </div>
        </div>
      </div>

      <!-- Setting Card-->
      <div class="card shadow-sm">
        <div class="card-body direction-rtl">
          <p class="mb-2">Register &amp; Logout</p>

          <div class="single-setting-panel">
            <a href="register.html">
              <div class="icon-wrapper bg-primary">
                <i class="bi bi-person"></i>
              </div>
              Create New Account
            </a>
          </div>

          <div class="single-setting-panel">
            <a href="login.html">
              <div class="icon-wrapper bg-danger">
                <i class="bi bi-box-arrow-right"></i>
              </div>
              Logout
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection