@extends('layouts.app')

@section('title', 'Tambah Poin')

@section('content')
    <div class="container py-3">
        <h4>Tambah Poin</h4>

        <!-- Filter -->
        <form action="{{ route('admin.insentif.add-poin') }}" method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <label for="rt" class="form-label">Filter RT</label>
                    <select name="rt" id="rt" class="form-control">
                        <option value="">Semua RT</option>
                        <option value="RT 12" {{ request('rt') == 'RT 12' ? 'selected' : '' }}>RT 12</option>
                        <option value="RT 13" {{ request('rt') == 'RT 13' ? 'selected' : '' }}>RT 13</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="sort" class="form-label">Urutkan Berdasarkan</label>
                    <select name="sort" id="sort" class="form-control">
                        <option value="">Default</option>
                        <option value="lapor_terbanyak" {{ request('sort') == 'lapor_terbanyak' ? 'selected' : '' }}>Jumlah
                            Lapor Terbanyak</option>
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Terapkan Filter</button>
                </div>
            </div>
        </form>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Tambah Poin -->
        <form action="{{ route('admin.insentif.add-poin') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="user_id">Pilih Pengguna</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} (Poin: {{ $user->poin }})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="poin">Jumlah Poin</label>
                <input type="number" name="poin" id="poin" class="form-control" required>
            </div>
            <!-- Tombol Tambah Poin dan Kembali -->
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Tambah Poin</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
@endsection
