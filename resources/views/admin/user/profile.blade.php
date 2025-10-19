@extends('layouts.admin.admin')

@section('content')
<div class="container-fluid mt-4">
    <h2>My Profile</h2>
    <hr>

    <div class="row">
        <div class="col-md-6 mb-3">
            <p><strong>Name:</strong> {{ $user->name }}</p>
        </div>
        <div class="col-md-6 mb-3">
            <p><strong>Email:</strong> {{ $user->email }}</p>
        </div>
        @if($user->phone)
        <div class="col-md-6 mb-3">
            <p><strong>Phone:</strong> {{ $user->phone }}</p>
        </div>
        @endif
        @if($user->role)
        <div class="col-md-6 mb-3">
            <p><strong>Role:</strong> {{ $user->role }}</p>
        </div>
        @endif
        <div class="col-md-6 mb-3">
            <p><strong>Joined At:</strong> {{ $user->created_at->format('d-m-Y H:i') }}</p>
        </div>
        <div class="col-md-6 mb-3">
            <p><strong>Last Updated:</strong> {{ $user->updated_at->format('d-m-Y H:i') }}</p>
        </div>
    </div>
</div>
@endsection
