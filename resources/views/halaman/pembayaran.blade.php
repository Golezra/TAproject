@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Pembayaran Laporan</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Detail Laporan</h5>
            <p><strong>Jenis Sampah:</strong> {{ ucfirst($laporan->jenis_sampah) }}</p>
            <p><strong>Berat Sampah:</strong> {{ $laporan->berat_sampah }} KG</p>
            <p><strong>Keterangan Lokasi:</strong> {{ $laporan->keterangan_lokasi_sampah }}</p>
            <p><strong>Nominal Pembayaran:</strong> Rp {{ number_format($laporan->nominal, 0, ',', '.') }}</p>
        </div>
    </div>

    <form action="{{ route('riwayat-lapor.bayar', $laporan->id) }}" method="POST" class="mt-4">
        @csrf
        <button type="submit" class="btn btn-primary btn-lg" onclick="return confirm('Apakah Anda yakin ingin membayar laporan ini?')">
            Bayar Sekarang
        </button>
    </form>
</div>
@endsection