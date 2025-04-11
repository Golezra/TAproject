@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mt-4">Laporan Sudah Diangkut</h1>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Warga</th>
                <th>Lokasi</th>
                <th>Ket Lokasi</th>
                <th>Jenis Sampah</th>
                <th>Berat</th>
                <th>Foto</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->name ?? 'Tidak diketahui' }}</td>
                    <td>{{ $item->lokasi_sampah }}</td>
                    <td>{{ $item->keterangan_lokasi_sampah ?? '-' }}</td>
                    <td>{{ ucfirst($item->jenis_sampah) }}</td>
                    <td>{{ $item->berat_sampah }} kg</td>
                    <td>
                        @if ($item->foto_sampah)
                            <img src="{{ asset('storage/' . $item->foto_sampah) }}" alt="Foto Sampah" width="100">
                        @else
                            Tidak ada foto
                        @endif
                    </td>
                    <td>{{ ucfirst($item->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada laporan yang sudah diangkut.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <!-- Tombol Kembali ke Dashboard -->
    <div class="text-center mt-4">
        <a href="{{ route('tim-operasional.dashboard') }}" class="btn btn-primary">Kembali ke Dashboard</a>
    </div>
</div>
@endsection