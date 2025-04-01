@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mt-4">Tim Operasional Dashboard</h1>
    <div class="row mt-5">
        <!-- Card: Laporan Menunggu Diangkut -->
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Laporan Menunggu Diangkut</div>
                <div class="card-body">
                    <h5 class="card-title">Total Laporan</h5>
                    <p class="card-text">Lihat laporan yang perlu diangkut.</p>
                    <a href="{{ route('tim-operasional.laporan.menunggu') }}" class="btn btn-light">View Details</a>
                </div>
            </div>
        </div>

        <!-- Card: Laporan Sudah Diangkut -->
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Laporan Sudah Diangkut</div>
                <div class="card-body">
                    <h5 class="card-title">Total Laporan</h5>
                    <p class="card-text">Lihat laporan yang sudah diangkut.</p>
                    <a href="{{ route('tim-operasional.laporan.diangkut') }}" class="btn btn-light">View Details</a>
                </div>
            </div>
        </div>

        <!-- Card: Profil Tim Operasional -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Profil</div>
                <div class="card-body">
                    <h5 class="card-title">Profil Tim Operasional</h5>
                    <p class="card-text">Lihat dan perbarui informasi profil Anda.</p>
                    <a href="{{ route('tim-operasional.profil') }}" class="btn btn-light">View Details</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection