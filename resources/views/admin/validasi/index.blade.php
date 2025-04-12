@extends('layouts.app')

@section('title', 'Validasi Laporan')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Validasi Laporan Sampah</h1>

    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

    <a href="{{ route('admin.validasi.cetak-pdf', request()->all()) }}" class="btn btn-danger mb-3">
        <i class="bi bi-file-earmark-pdf"></i> Cetak PDF
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.validasi.index') }}" method="GET" class="mb-4">
        <div class="row">
            <!-- Filter Bulan -->
            <div class="col-md-4">
                <label for="bulan" class="form-label">Filter Bulan</label>
                <select name="bulan" id="bulan" class="form-select">
                    <option value="">Semua Bulan</option>
                    @foreach (range(1, 12) as $month)
                        <option value="{{ $month }}" {{ request('bulan') == $month ? 'selected' : '' }}>
                            {{ DateTime::createFromFormat('!m', $month)->format('F') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Tahun -->
            <div class="col-md-4">
                <label for="tahun" class="form-label">Filter Tahun</label>
                <select name="tahun" id="tahun" class="form-select">
                    <option value="">Semua Tahun</option>
                    @foreach (range(2025, date('Y') + 5) as $year)
                        <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-lg">
            <thead>
                <tr>
                    <th>Foto Sampah</th>
                    <th>Nama Pelapor</th>
                    <th>Lokasi Sampah</th>
                    <th>Jenis Sampah</th>
                    <th>Berat (Kg)</th>
                    <th>Nominal (Rp)</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($laporan as $item)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $item->foto_sampah) }}" 
                                 alt="Foto Sampah" 
                                 class="img-thumbnail zoomable" 
                                 style="width: 100px; height: 100px; object-fit: cover; cursor: pointer;" 
                                 data-bs-toggle="modal" 
                                 data-bs-target="#fotoModal" 
                                 onclick="showImageInModal('{{ asset('storage/' . $item->foto_sampah) }}')">
                        </td>
                        <td>{{ $item->user->name ?? 'Tidak diketahui' }}</td>
                        <td>{{ $item->lokasi_sampah }}</td>
                        <td>{{ ucfirst($item->jenis_sampah) }}</td>
                        <td>{{ $item->berat_sampah }}</td>
                        <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge bg-warning">{{ ucfirst($item->status) }}</span>
                        </td>
                        <td>
                            <form action="{{ route('admin.validasi', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Validasi</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">Tidak ada laporan untuk divalidasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal untuk Zoom Foto -->
<div class="modal fade" id="fotoModal" tabindex="-1" aria-labelledby="fotoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fotoModalLabel">Foto Sampah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Foto Sampah" class="img-fluid" style="cursor: zoom-in;">
            </div>
        </div>
    </div>
</div>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const images = document.querySelectorAll('.zoomable');
        images.forEach(img => {
            img.addEventListener('click', function () {
                if (this.style.transform === 'scale(3)') {
                    this.style.transform = 'scale(1)'; // Zoom out
                } else {
                    this.style.transform = 'scale(3)'; // Zoom in lebih besar
                }
            });
        });
    });

    function showImageInModal(imageUrl) {
        const modalImage = document.getElementById('modalImage');
        modalImage.src = imageUrl; // Set sumber gambar di modal
    }
</script>