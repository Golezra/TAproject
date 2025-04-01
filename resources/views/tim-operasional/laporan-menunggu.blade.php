@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mt-4">Laporan Menunggu Diangkut</h1>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>No</th>
                <th>Lokasi</th>
                <th>Jenis Sampah</th>
                <th>Berat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->lokasi_sampah }}</td>
                    <td>{{ ucfirst($item->jenis_sampah) }}</td>
                    <td>{{ $item->berat_sampah }} kg</td>
                    <td>
                        <form action="{{ route('riwayat-lapor.ubah-status', ['id' => $item->id, 'status' => 'diangkut']) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success btn-sm">Tandai Diangkut</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada laporan menunggu diangkut.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection