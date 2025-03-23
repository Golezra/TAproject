@extends('layouts.app')

@section('title', 'Edit Laporan')

@section('content')
    <div class="container py-3">
        <h4>Edit Laporan Sampah</h4>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('riwayat-lapor.update', $laporan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST') <!-- Pastikan method sesuai dengan route -->
            <div class="form-group">
                <label for="lokasisampah">Lokasi Sampah</label>
                <input type="text" name="lokasisampah" id="lokasisampah" class="form-control"
                    value="{{ $laporan->lokasi_sampah }}" required>
            </div>
            <div class="form-group">
                <label for="keteranganlokasisampah">Keterangan Lokasi Sampah</label>
                <input type="text" name="keteranganlokasisampah" id="keteranganlokasisampah" class="form-control"
                    value="{{ $laporan->keterangan_lokasi_sampah }}" required>
            </div>
            <div class="form-group">
                <label for="jenisSampah">Jenis Sampah</label>
                <select name="jenisSampah" id="jenisSampah" class="form-control" required>
                    <option value="organik" {{ $laporan->jenis_sampah == 'organik' ? 'selected' : '' }}>Organik</option>
                    <option value="anorganik" {{ $laporan->jenis_sampah == 'anorganik' ? 'selected' : '' }}>Anorganik
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label for="beratSampah">Berat Sampah (KG)</label>
                <input type="number" name="beratSampah" id="beratSampah" class="form-control"
                    value="{{ $laporan->berat_sampah }}" required>
            </div>
            <div class="form-group">
                <label for="fotoSampah">Foto Sampah</label>
                <input type="file" name="fotoSampah" id="fotoSampah" class="form-control">
                @if ($laporan->foto_sampah)
                    <img src="{{ asset('storage/' . $laporan->foto_sampah) }}" alt="Foto Sampah" width="100"
                        class="mt-2">
                @endif
            </div>
            <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
        </form>
    </div>
@endsection
