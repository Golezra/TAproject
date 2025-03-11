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
  <link rel="stylesheet" href="{{ asset('style.css') }}">

  <!-- Web App Manifest -->
  <link rel="manifest" href="{{ asset('manifest.json') }}" id="manifest.json">
</head>

<body>
  <!-- Preloader -->
  <div id="preloader">
    <div class="spinner-grow text-primary" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>
@if(session('success'))
    <div class="toast toast-autohide custom-toast-1 toast-success home-page-toast shadow" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="60000" data-bs-autohide="true" id="successToast">
        <div class="toast-body p-4">
            <div class="toast-text me-2 d-flex align-items-center">
                <img src="{{ asset('img/core-img/success.gif') }}" alt="Success Icon" class="me-2" style="width: 50px; height: 50px;">
                <div>
                    <h6 class="text-success mb-0">Success</h6>
                    <span class="d-block mb-2">{{ session('success') }}</span>
                </div>
            </div>
            <button class="btn btn-close btn-close-white position-absolute p-2" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
@endif

@if(session('error'))
  <div class="toast toast-autohide custom-toast-1 toast-danger home-page-toast shadow" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="60000" data-bs-autohide="true" id="errorToast">
      <div class="toast-body p-4">
          <div class="toast-text me-2 d-flex align-items-center">
              <img src="{{ asset('img/core-img/bell.gif') }}" alt="Error Icon" class="me-2" style="width: 50px; height: 50px;">
              <div>
                  <h6 class="text-warning mb-0">Error</h6>
                  <span class="d-block mb-2">{{ session('error') }}</span>
              </div>
          </div>
          <button class="btn btn-close btn-close-white position-absolute p-2" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
  </div>
@endif
  <!-- Internet Connection Status -->
  <div class="internet-connection-status" id="internetStatus"></div>

  <!-- Back Button -->
  <div class="login-back-button">
    <a href="{{ url('/login') }}">
      <i class="bi bi-arrow-left-short"></i>
    </a>
  </div>

  <!-- Login Wrapper Area -->
  <div class="login-wrapper d-flex align-items-center justify-content-center">
    <div class="custom-container">
      <div class="text-center px-4">
        <img class="login-intro-img" src="{{ asset('img/bg-img/register.png') }}" alt="">
      </div>

      <!-- Register Form -->
      <div class="register-form mt-4">
        <h6 class="mb-3 text-center">Registrasi Sireum Smart</h6>
        
        
        <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group text-start mb-3">
            <input class="form-control" type="text" value="{{ Session::get('name') }}" name="name" placeholder="Nama Pengguna">
          </div>
          
          <div class="form-group text-start mb-3">
            <input class="form-control" type="text" value="{{ Session::get('email') }}" name="email" placeholder="Email (ex: email@gmail.com)">
          </div>

          <div class="form-group text-start mb-3 position-relative">
            <input class="form-control" id="psw-input" type="password" name="password" placeholder="Kata Sandi Baru">
            <div class="position-absolute" id="password-visibility">
              <i class="bi bi-eye"></i>
              <i class="bi bi-eye-slash"></i>
            </div>
          </div>

          <div class="mb-3">
            <div class="element-heading mt-3">
              <label for="profile_picture" class="form-label">Foto Profil</label>
            </div>  
          </div>

          <div class="container">
              <div class="card">
                  <div class="card-body">
                      <div class="file-upload-card">
                          <i class="bi bi-file-earmark-arrow-up text-primary display-2"></i>
                          <h5 class="mt-2 mb-4">Masukkan Foto terbaik Anda</h5>
                          <!-- Form -->
                          <div class="form-file">
                              <input class="form-control d-none" id="customFile2" type="file" name="pict">
                              <label class="form-file-label justify-content-center" for="customFile2">
                                  <span class="form-file-button btn btn-primary shadow w-100">Masukkan Foto</span>
                              </label>
                              <div id="uploadMessage" class="text-success"></div>
                          </div>
                          <h6 class="mt-4 mb-0">Supported files</h6>
                          <small>.jpg .png .jpeg</small>
                      </div>
                  </div>
              </div>
          </div>
          
          <script>
             document.getElementById('customFile2').addEventListener('change', function(event) {
                 const fileInput = event.target;
                 const uploadMessage = document.getElementById('uploadMessage');
                 const fileLabel = document.querySelector('label[for="customFile2"]'); // Menemukan label
             
                 if (fileInput.files.length > 0) {
                     const fileName = fileInput.files[0].name;
                     uploadMessage.textContent = 'Berhasil menginput foto: ' + fileName; // Menampilkan pesan berhasil
                     fileLabel.style.display = 'none'; // Menyembunyikan label
                 } else {
                     uploadMessage.textContent = 'Tidak ada file yang dipilih.'; // Pesan jika tidak ada file
                 }
             });
          </script>
          
          <div class="mb-3">
            <label for="phone" class="form-label">Nomor Telepon</label>
            <input type="tel" class="form-control" id="phone" name="phone_number" value="{{ Session::get('phone_number') }}" required placeholder="08xxxxxxxx">
          </div>
          
          <div class="mb-3">
              <label class="form-label">Alamat (Pilih RT)</label>
              <div class="form-check">
                  <input class="form-check-input" type="radio" name="rt" id="rt12" value="RT 12" required>
                  <label class="form-check-label" for="rt12">
                      RT 12
                  </label>
              </div>
              <div class="form-check">
                  <input class="form-check-input" type="radio" name="rt" id="rt13" value="RT 13" required>
                  <label class="form-check-label" for="rt13">
                      RT 13
                  </label>
              </div>
          </div>
          
          <div class="mb-3">
              <label for="nik" class="form-label">NIK (Nomor Induk Kependudukan)</label>
              <input type="text" class="form-control" id="nik" name="nik" value="{{ Session::get('nik') }}" required maxlength="16" minlength="16" placeholder="Masukkan NIK">
          </div>

          <div class="mb-3" id="pswmeter"></div>

          <div class="form-check mb-3">
            <input class="form-check-input" id="checkedCheckbox" type="checkbox" value="" checked>
            <label class="form-check-label text-muted fw-normal" for="checkedCheckbox">Saya setuju dengan syarat &amp;
              ketentuan.</label>
          </div>

          <button class="btn btn-primary w-100" type="submit">Daftar</button>
        </form>
      </div>

      <!-- Login Meta -->
      <div class="login-meta-data text-center">
       <p class="mt-3 mb-0">Sudah punya akun? <a class="stretched-link" href="{{ route('login') }}">Masuk</a></p>
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