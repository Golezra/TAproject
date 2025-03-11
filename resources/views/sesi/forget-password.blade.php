@extends('layouts.app')

@section('title', 'SireumSmart | Forget Password')

@section('content')
@include('components.alert')

<!-- Back Button -->
<div class="login-back-button">
    <a href="{{ route('login') }}">
      <i class="bi bi-arrow-left-short"></i>
    </a>
</div>

  <!-- Login Wrapper Area -->
  <div class="login-wrapper d-flex align-items-center justify-content-center">
    <div class="custom-container">
      <div class="text-center px-4">
        <img class="login-intro-img" src="{{ asset('img/bg-img/37.png') }}" alt="">
      </div>

      <!-- Register Form -->
      <div class="register-form mt-4">
        <form action="{{ route('sesi.store-forget-password') }}" method="POST">
          @csrf
          <div class="form-group text-start mb-3">
            <input class="form-control" type="text" name="email" placeholder="Enter your email address">
          </div>
          <button class="btn btn-primary w-100" type="submit">Reset Password</button>
        </form>
      </div>
    </div>
  </div>

  @endsection