@extends('layouts.app')

@section('title', 'Pembayaran Laporan')

@section('content')
<div class="container py-5">
    <h1>Pembayaran Laporan</h1>
    <p><strong>Jenis Sampah:</strong> {{ ucfirst($laporan->jenis_sampah) }}</p>
    <p><strong>Berat Sampah:</strong> {{ $laporan->berat_sampah }} Kg</p>
    <p><strong>Nominal:</strong> Rp {{ number_format($laporan->nominal, 0, ',', '.') }}</p>

    <form action="{{ route('riwayat-lapor.bayar', $laporan->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
    </form>
</div>
@endsection