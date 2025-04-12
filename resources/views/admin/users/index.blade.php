@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Manage Users</h1>

    <!-- Filter Form -->
    <form action="{{ route('admin.users.index') }}" method="GET" class="mb-4">
        <div class="row">
            <!-- Filter RT -->
            <div class="col-md-4">
                <label for="rt" class="form-label">Filter by RT</label>
                <select name="rt" id="rt" class="form-select">
                    <option value="">All RT</option>
                    @foreach ($rts as $rt)
                        <option value="{{ $rt }}" {{ request('rt') == $rt ? 'selected' : '' }}>{{ $rt }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Jumlah Laporan -->
            <div class="col-md-4">
                <label for="sort" class="form-label">Sort by Jumlah Laporan</label>
                <select name="sort" id="sort" class="form-select">
                    <option value="">Default</option>
                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Terbanyak</option>
                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Terkecil</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
    </form>

    <!-- Tabel User -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Alamat</th>
                <th>Jumlah Lapor</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->role) }}</td>
                <td>{{ $user->rt }}</td>
                <td>{{ $user->jumlah_lapor }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tombol Kembali ke Dashboard Admin -->
    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary mb-3">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>
@endsection