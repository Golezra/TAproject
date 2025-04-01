@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mt-4">Laporan Sudah Diangkut</h1>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>No</th>
                <th>Lokasi</th>
                <th>Jenis Sampah</th>
                <th>Berat</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->lokasi_sampah }}</td>
                    <td>{{ ucfirst($item->jenis_sampah) }}</td>
                    <td>{{ $item->berat_sampah }} kg</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada laporan yang sudah diangkut.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection