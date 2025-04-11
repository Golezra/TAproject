@extends('layouts.app')

@section('title', 'Admin Reports')

@section('content')
<div class="container py-5">
    <h1>Admin Reports</h1>
    <p>Halaman ini berisi laporan dan analitik sistem.</p>

    <div class="row mt-4">
        <!-- Card 1: Total Users -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Users</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalUsers }}</h5>
                    <p class="card-text">Jumlah total pengguna yang terdaftar di sistem.</p>
                </div>
            </div>
        </div>

        <!-- Card 2: Active Sessions -->
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Active Sessions</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $activeSessions }}</h5>
                    <p class="card-text">Jumlah login aktif saat ini di sistem.</p>
                </div>
            </div>
        </div>

        <!-- Card 3: System Errors -->
        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">System Errors</div>
                <div class="card-body">
                    <h5 class="card-title">Error Terbaru</h5>
                    <ul class="list-group text-dark">
                        @forelse ($systemErrors as $error)
                            <li class="list-group-item">{{ $error }}</li>
                        @empty
                            <li class="list-group-item">Tidak ada error yang terdeteksi.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h2>Daftar Laporan Sampah Terbaru </h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Activity</th>
                    <th>Nama Warga</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recentActivities as $index => $activity)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ ucfirst($activity->jenis_sampah) }} ({{ $activity->berat_sampah }} kg)</td>
                        <td>{{ $activity->user->name ?? 'Tidak diketahui' }}</td>
                        <td>{{ $activity->created_at->translatedFormat('d F Y H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">Kembali</a>

</div>
@endsection