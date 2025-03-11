<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Affan - PWA Mobile HTML Template">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <meta name="theme-color" content="#0134d4">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">

  <!-- Title -->
  <title>Affan - PWA Mobile HTML Template</title>

  <!-- Favicon -->
  <link rel="icon" href="img/core-img/favicon.ico">
  <link rel="apple-touch-icon" href="img/icons/icon-96x96.png">
  <link rel="apple-touch-icon" sizes="152x152" href="img/icons/icon-152x152.png">
  <link rel="apple-touch-icon" sizes="167x167" href="img/icons/icon-167x167.png">
  <link rel="apple-touch-icon" sizes="180x180" href="img/icons/icon-180x180.png">

  <!-- Style CSS -->
  <link rel="stylesheet" href="{{asset('style.css')}}">

  <!-- Web App Manifest -->
  <link rel="manifest" href="{{asset('manifest.json')}}">
</head>

<body>
  <!-- Preloader -->
  <div id="preloader">
    <div class="spinner-grow text-primary" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>

  <!-- Internet Connection Status -->
  <div class="internet-connection-status" id="internetStatus"></div>

  <!-- Back Button -->
  <div class="login-back-button">
    <a href="{{ url('/') }}">
      <i class="bi bi-arrow-left-short"></i>
    </a>
  </div>

  @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
  @endif

  <!-- Login Wrapper Area -->
  <div class="login-wrapper d-flex align-items-center justify-content-center">
    <div class="custom-container">
      <div class="text-center px-4">
        <img class="login-intro-img" src="{{ asset('img/bg-img/40.png') }}" alt="">
      </div>

      <!-- Register Form -->
      <div class="register-form mt-4">
        <form action="{{ route('sesi.store-change-password') }}" method="POST">
          @csrf
          <h6 class="mb-3 text-center">Update your password</h6>
          
          <div class="form-group text-start mb-3">
              <input class="form-control" type="text" name="recovery_code" placeholder="Enter 6 digit security code" required>
          </div>
          
          <div class="form-group text-start mb-3 position-relative">
              <input class="form-control" id="psw-input" type="password" name="new_password" placeholder="New password" required>
              <div class="position-absolute" id="password-visibility">
                  <i class="bi bi-eye"></i>
                  <i class="bi bi-eye-slash"></i>
              </div>
          </div>
          
          <div class="mb-3" id="pswmeter"></div>
          
          <div class="form-group text-start mb-3">
              <input class="form-control" type="password" name="confirm_password" placeholder="Re-write password" required>
          </div>
          
          <button class="btn btn-primary w-100" type="submit">Update Password</button>
        </form>
      </div>
    </div>
  </div>

  <!-- All JavaScript Files -->
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/internet-status.js') }}"></script>
  <script src="{{ asset('js/dark-rtl.js') }}"></script>
  <script src="{{ asset('js/pswmeter.js') }}"></script>
  <script src="{{ asset('js/active.js') }}"></script>
  <script src="{{ asset('js/pwa.js') }}"></script>
</body>

</html>