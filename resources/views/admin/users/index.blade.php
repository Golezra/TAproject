@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Manage Users</h1>

    
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
                        <a href="#" class="btn btn-warning btn-sm">Edit</a>
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