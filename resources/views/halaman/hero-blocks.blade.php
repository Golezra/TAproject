@extends('layouts.app')


@section('title', ' Sireum Smart')
@section('content')

  <!-- Hero Block Wrapper -->
  <div class="hero-block-wrapper bg-primary">
    <!-- Styles -->
    <div class="hero-block-styles">
      <div class="hb-styles1" style="background-image: url('img/core-img/dot.png')"></div>
      <div class="hb-styles2"></div>
      <div class="hb-styles3"></div>
    </div>

    <div class="custom-container">
      <!-- Skip Page -->
      <div class="skip-page">
        <a href="{{ url('/home') }}">Skip</a>
      </div>

      <!-- Hero Block Content -->
      <div class="hero-block-content">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <img class="mb-4" src="img/bg-img/19.png" alt="">
        <h2 class="display-4 text-white mb-3">Build your website easier with Affan</h2>
        <p class="text-white">Affan is a modern and latest technology based PWA mobile HTML template.</p>
        <a class="btn btn-warning btn-lg w-100" href="{{ asset('/sesi')}}">Get Started</a> 
      </div>
    </div>
  </div>

  @endsection