@extends('layouts.app')

@section('title', 'SireumSmart | Login')

@section('content')

@include('components.alert')

  <!-- Back Button -->
  <div class="login-back-button">
    <a href="{{ asset('/') }}">
      <i class="bi bi-arrow-left-short"></i>
    </a>
  </div>

  <!-- Login Wrapper Area -->
  <div class="login-wrapper d-flex align-items-center justify-content-center">
    <div class="custom-container">
      <div class="text-center px-4">
        <img class="login-intro-img" src="{{ asset('img/bg-img/login.png') }}" alt="">
      </div>

      @if(session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
      @endif

      <!-- Register Form -->
      <div class="register-form mt-4">
        <h6 class="mb-3 text-center">Log in to continue to the Sireum Smart</h6>

        <form action="/sesi/login" method="POST">
          @csrf
          <div class="form-group">
            <input class="form-control" type="email" value="{{ Session::get('email') }}" name="email" placeholder="Masukkan Email">
          </div>

          <div class="form-group position-relative">
            <input class="form-control" name="password" id="psw-input" type="password" placeholder="Masukkan Kata Sandi">
            <div class="position-absolute" id="password-visibility">
              <i class="bi bi-eye"></i>
              <i class="bi bi-eye-slash"></i>
            </div>
          </div>

          <button name="submit" class="btn btn-primary w-100" type="submit">Masuk</button>
        </form>
      </div>

      <!-- Login Meta -->
      <div class="login-meta-data text-center">
        <a class="stretched-link forgot-password d-block mt-3 mb-1" href="{{ route('sesi.forget-password') }}">Lupa
          Password?</a>
        <p class="mb-0">Belum punya akun? <a class="stretched-link" href="{{ route('sesi.register') }}">Daftar Sekarang</a></p>    </div>
  </div>
@endsection