@extends('layouts.admin.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container-fluid">
        <h2>Welcome, {{ auth()->user()->name ?? 'Admin' }} 👋</h2>
        <p class="text-muted">Here’s an overview of your system performance.</p>

        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5>Total Users</h5>
                        <p class="display-6 fw-bold">125</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5>Total Partners</h5>
                        <p class="display-6 fw-bold">42</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
