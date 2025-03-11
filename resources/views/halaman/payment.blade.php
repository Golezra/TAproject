@extends('layouts.app')

@section('title', 'Payment')

@section('content')

@include('components.alert')

<div class="page-content-wrapper py-3">
    <!-- Element Heading -->
    <div class="container">
        <div class="element-heading">
            <h6>Pembayaran Berhasil</h6>
            <p>Terima kasih telah melaporkan sampah. Laporan Anda telah berhasil disimpan.</p>
            <a href="{{ route('dashboard.warga') }}" class="btn btn-primary">Kembali ke Dashboard</a>
        </div>
    </div>
</div>

@endsection