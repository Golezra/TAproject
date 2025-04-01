@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mt-4">Admin Dashboard</h1>
    <div class="row mt-5">
        <!-- Card Example -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Users</div>
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text">Manage all registered users.</p>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-light">View Details</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Reports</div>
                <div class="card-body">
                    <h5 class="card-title">View Reports</h5>
                    <p class="card-text">Access system reports and analytics.</p>
                    <a href="{{ route('admin.reports.index') }}" class="btn btn-light">View Details</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Settings</div>
                <div class="card-body">
                    <h5 class="card-title">System Settings</h5>
                    <p class="card-text">Configure application settings.</p>
                    <a href="{{ route('admin.settings.index') }}" class="btn btn-light">View Details</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection