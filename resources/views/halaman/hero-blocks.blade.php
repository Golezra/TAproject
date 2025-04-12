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

        <div class="container h-100 d-flex align-items-center justify-content-center text-center">
            <div class="row">
                <div class="col-12">
                    <img class="mb-4 img-fluid" src="{{ asset('img/bg-img/19.png') }}" alt="Hero Image" style="max-height: 300px;">
                    <h2 class="hero-title text-white mb-3">Sireum Smart: Teknologi Cerdas di Genggaman Anda</h2>
                    <p class="text-white">Solusi kampung Anda tidak didatangi oleh tim Pandawara Grup atau Gubernur Jawa Barat</p>
                    <a class="btn btn-warning btn-lg w-100" href="{{ asset('/sesi') }}">Get Started</a>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>

  @endsection