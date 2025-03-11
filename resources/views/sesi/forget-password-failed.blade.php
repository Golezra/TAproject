@extends('layouts.app')

@section('title', 'SireumSmart | Forget Password Failed')

@section('content')

<!-- Back Button-->
<div class="login-back-button">
    <a href="{{ route('login') }}">
      <i class="bi bi-arrow-left-short"></i>
    </a>
</div

  <!-- Back Button -->
  <div class="login-back-button">
    <a href="login.html">
      <i class="bi bi-arrow-left-short"></i>
    </a>
  </div>

  <!-- Wrapper -->
  <div class="login-wrapper d-flex align-items-center justify-content-center text-center">
    <div class="custom-container">
      <div class="text-center px-2">
        <img class="login-intro-img mb-4" src="img/bg-img/38.png" alt="">
        
        <!-- Reset Password Message -->
        <p class="mb-4">Ooops! Your entered email is wrong. Please enter your correct email address again.</p>
        
        <!-- Go Back Button -->
        <a class="btn btn-danger" href="{{ asset('sesi.forget-password') }}">Try Again</a>
      </div>
    </div>
  </div>

  @endsection