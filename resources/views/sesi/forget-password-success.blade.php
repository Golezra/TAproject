@extends('layouts.app')

@section('title', 'SireumSmart | Forget Password Success')

@section('content')
@include('components.alert')

<!-- Back Button-->
<div class="login-back-button">
    <a href="{{ route('login') }}">
      <i class="bi bi-arrow-left-short"></i>
    </a>
</div>

  <!-- Wrapper -->
  <div class="login-wrapper d-flex align-items-center justify-content-center text-center">
    <div class="custom-container">
      <div class="text-center px-2">
        <img class="login-intro-img mb-4" src="img/bg-img/38.png" alt="">
        
        <h3>Check your mailbox!</h3>        
        <p class="mb-4">We have sent a password recovery email in your email. This email contain 8 digit security code.
        </p>

        <!-- Go Back Button -->
        <a class="btn btn-primary" href="{{ route('sesi.change-password') }}" id="change-password">Change Password</a>
      </div>
    </div>
  </div>

  @endsection