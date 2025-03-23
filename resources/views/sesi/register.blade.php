@extends('layouts.app')

@section('title', 'SireumSmart | Registrasi')

@section('content')

    @include('components.alert')

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
                        <input class="form-control" type="text" name="name" placeholder="Nama Lengkap" id="nameInput"
                            required>
                        <small id="nameAlert" class="text-danger d-none">Nama lengkap tidak boleh mengandung angka atau
                            simbol seperti !@#$%^&*(),.<>/?=+-_</small>
                    </div>

                    <script>
                        document.getElementById('nameInput').addEventListener('input', function(event) {
                            const nameInput = event.target;
                            const nameAlert = document.getElementById('nameAlert');
                            const nameRegex = /^[a-zA-Z\s]+$/; // Only letters and spaces are allowed

                            if (!nameRegex.test(nameInput.value)) {
                                nameAlert.classList.remove('d-none'); // Show alert
                                nameInput.style.borderColor = 'red'; // Highlight input with red border
                                nameInput.setCustomValidity('Nama lengkap tidak valid.');
                            } else {
                                nameAlert.classList.add('d-none'); // Hide alert
                                nameInput.style.borderColor = ''; // Reset border color
                                nameInput.setCustomValidity('');
                            }
                        });
                    </script>

                    <div class="form-group text-start mb-3">
                        <input class="form-control" type="email" name="email" placeholder="Email (ex: email@gmail.com)"
                            required id="emailInput">
                        <small id="emailAlert" class="text-danger d-none">Email harus menyertakan simbol @</small>
                    </div>

                    <script>
                        document.getElementById('emailInput').addEventListener('input', function(event) {
                            const emailInput = event.target;
                            const emailAlert = document.getElementById('emailAlert');

                            if (!emailInput.value.includes('@')) {
                                emailAlert.classList.remove('d-none'); // Show alert
                                emailInput.style.borderColor = 'red'; // Highlight input with red border
                            } else {
                                emailAlert.classList.add('d-none'); // Hide alert
                                emailInput.style.borderColor = ''; // Reset border color
                            }
                        });
                    </script>

                    <div class="form-group text-start mb-3 position-relative">
                        <input class="form-control" id="psw-input" type="password" name="password"
                            placeholder="Kata Sandi Baru" minlength="6" maxlength="6" required>
                        <div class="position-absolute" id="password-visibility">
                            <i class="bi bi-eye"></i>
                            <i class="bi bi-eye-slash"></i>
                        </div>
                        <small id="passwordAlert" class="text-danger d-none">Kata sandi harus terdiri dari 6
                            karakter.</small>
                    </div>

                    <script>
                        document.getElementById('psw-input').addEventListener('input', function(event) {
                            const passwordInput = event.target;
                            const passwordAlert = document.getElementById('passwordAlert');

                            if (passwordInput.value.length === 6) {
                                passwordInput.style.borderColor = 'green'; // Change border color to green
                                passwordAlert.classList.add('d-none'); // Hide alert
                                passwordInput.setCustomValidity('');
                            } else {
                                passwordInput.style.borderColor = 'red'; // Change border color to red
                                passwordAlert.classList.remove('d-none'); // Show alert
                                passwordInput.setCustomValidity('Kata sandi harus terdiri dari 6 karakter.');
                            }
                        });
                    </script>

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
                                        <input class="form-control d-none" id="customFile2" type="file" name="pict"
                                            required>
                                        <label class="form-file-label justify-content-center" for="customFile2">
                                            <span class="form-file-button btn btn-primary shadow w-100">Masukkan
                                                Foto</span>
                                        </label>
                                        <div id="uploadMessage" class="text-success"></div>
                                        <small id="photoAlert" class="text-danger d-none">Anda harus mengunggah
                                            foto.</small>
                                        <small id="photoSuccessAlert" class="text-success d-none">Foto berhasil
                                            disimpan!</small>
                                        <small id="photoErrorAlert" class="text-danger d-none">Gagal mengunggah foto.
                                            Silakan coba lagi.</small>
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
                            const photoAlert = document.getElementById('photoAlert');
                            const photoSuccessAlert = document.getElementById('photoSuccessAlert');
                            const photoErrorAlert = document.getElementById('photoErrorAlert');
                            const fileLabel = document.querySelector('label[for="customFile2"]'); // Menemukan label

                            if (fileInput.files.length > 0) {
                                const fileName = fileInput.files[0].name;
                                uploadMessage.textContent = 'Berhasil mengupload foto: ' + fileName; // Menampilkan pesan berhasil
                                fileLabel.style.display = 'none'; // Menyembunyikan label
                                photoAlert.classList.add('d-none'); // Sembunyikan alert
                                photoSuccessAlert.classList.remove('d-none'); // Tampilkan alert sukses
                                photoErrorAlert.classList.add('d-none'); // Sembunyikan alert gagal
                            } else {
                                uploadMessage.textContent = ''; // Kosongkan pesan berhasil
                                photoAlert.classList.remove('d-none'); // Tampilkan alert
                                photoSuccessAlert.classList.add('d-none'); // Sembunyikan alert sukses
                                photoErrorAlert.classList.remove('d-none'); // Tampilkan alert gagal
                            }
                        });

                        document.querySelector('form').addEventListener('submit', function(event) {
                            const fileInput = document.getElementById('customFile2');
                            const photoAlert = document.getElementById('photoAlert');
                            const photoErrorAlert = document.getElementById('photoErrorAlert');

                            if (fileInput.files.length === 0) {
                                event.preventDefault(); // Cegah pengiriman form
                                photoAlert.classList.remove('d-none'); // Tampilkan alert
                                photoErrorAlert.classList.remove('d-none'); // Tampilkan alert gagal
                            }
                        });
                    </script>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Nomor Telepon</label>
                        <input type="tel" class="form-control" id="phone" name="phone_number"
                            value="{{ Session::get('phone_number') }}" required placeholder="08xxxxxxxx">
                        <small id="phoneAlert" class="text-danger d-none">Nomor telepon harus dimulai dengan 0,
                            memiliki panjang antara 8-15 karakter, dan hanya berisi digit.</small>
                    </div>

                    <script>
                        document.getElementById('phone').addEventListener('input', function(event) {
                            const phoneInput = event.target;
                            const phoneValue = phoneInput.value;
                            const phoneAlert = document.getElementById('phoneAlert');

                            // Remove non-digit characters
                            phoneInput.value = phoneValue.replace(/\D/g, '');

                            // Validate phone number
                            if (phoneInput.value.length >= 8 && phoneInput.value.length <= 15 && phoneInput.value.startsWith('0')) {
                                phoneInput.style.borderColor = 'green'; // Change border color to green
                                phoneAlert.classList.add('d-none'); // Hide alert
                                phoneInput.setCustomValidity('');
                            } else {
                                phoneInput.style.borderColor = 'red'; // Change border color to red
                                phoneAlert.classList.remove('d-none'); // Show alert
                                phoneInput.setCustomValidity('Nomor telepon tidak valid.');
                            }
                        });
                    </script>

                    <div class="mb-3">
                        <label class="form-label">Alamat (Pilih RT)</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="rt" id="rt12" value="RT 12"
                                required>
                            <label class="form-check-label" for="rt12">
                                RT 12
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="rt" id="rt13" value="RT 13"
                                required>
                            <label class="form-check-label" for="rt13">
                                RT 13
                            </label>
                        </div>
                        <small class="text-muted" style="opacity: 0.6;">
                            Pilih RT tempat tinggal Anda, pilih salah satu RT
                            12 atau RT 13
                            <span style="color: red;">*</span>
                        </small>
                        <div id="rtAlert" class="text-danger d-none mt-2">Anda harus memilih salah satu RT.</div>
                    </div>

                    <script>
                        document.querySelector('form').addEventListener('submit', function(event) {
                            const rtInputs = document.querySelectorAll('input[name="rt"]');
                            const rtAlert = document.getElementById('rtAlert');
                            let isChecked = false;

                            rtInputs.forEach(input => {
                                if (input.checked) {
                                    isChecked = true;
                                }
                            });

                            if (!isChecked) {
                                event.preventDefault(); // Prevent form submission
                                rtAlert.classList.remove('d-none'); // Show alert
                            } else {
                                rtAlert.classList.add('d-none'); // Hide alert
                            }
                        });
                    </script>

                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK (Nomor Induk Kependudukan)</label>
                        <input type="text" class="form-control" id="nik" name="nik"
                            value="{{ Session::get('nik') }}" required maxlength="16" minlength="16"
                            placeholder="Masukkan NIK">
                        <small id="nikAlert" class="text-danger d-none">NIK harus terdiri dari 16 digit.</small>
                    </div>

                    <script>
                        document.getElementById('nik').addEventListener('input', function(event) {
                            const nikInput = event.target;
                            const nikValue = nikInput.value;
                            const nikAlert = document.getElementById('nikAlert');

                            // Remove non-digit characters
                            nikInput.value = nikValue.replace(/\D/g, '');

                            // Check if the length is exactly 16 digits
                            if (nikInput.value.length === 16) {
                                nikInput.style.borderColor = 'green'; // Change border color to green
                                nikAlert.classList.add('d-none'); // Hide alert
                                nikInput.setCustomValidity('');
                            } else {
                                nikInput.style.borderColor = 'red'; // Change border color to red
                                nikAlert.classList.remove('d-none'); // Show alert
                                nikInput.setCustomValidity('NIK harus terdiri dari 16 digit.');
                            }
                        });
                    </script>

                    <script>
                        document.getElementById('nik').addEventListener('input', function(event) {
                            const nikInput = event.target;
                            const nikValue = nikInput.value;

                            // Remove non-digit characters
                            nikInput.value = nikValue.replace(/\D/g, '');

                            // Check if the length is exactly 16 digits
                            if (nikInput.value.length === 16) {
                                nikInput.style.borderColor = 'green'; // Change border color to green
                                nikInput.setCustomValidity('');
                            } else {
                                nikInput.style.borderColor = 'red'; // Change border color to red
                                nikInput.setCustomValidity('NIK harus terdiri dari 16 digit.');
                            }
                        });
                    </script>

                    <div class="form-check mb-3">
                        <input class="form-check-input" id="checkedCheckbox" type="checkbox" value="" checked>
                        <label class="form-check-label text-muted fw-normal" for="checkedCheckbox">Saya setuju dengan
                            syarat &amp;
                            ketentuan.</label>
                    </div>

                    <button class="btn btn-primary w-100" type="submit">Daftar</button>
                </form>
            </div>

            <!-- Login Meta -->
            <div class="login-meta-data text-center">
                <p class="mt-3 mb-0">Sudah punya akun? <a class="stretched-link" href="{{ route('login') }}">Masuk</a>
                </p>
            </div>
        </div>
    </div>
@endsection
