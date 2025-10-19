@extends('layouts.admin.admin')

@section('content')
<div class="container-fluid mt-4">
    <h2>Website Settings</h2>
    <hr>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row align-items-center">
            <div class="col-md-3 mb-3">
                <label>Site Name</label>
                <input type="text" name="site_name" class="form-control" value="{{ old('site_name', $settings['site_name']) }}" required>
            </div>
    
            <div class="col-md-3 mb-3">
                <label>Admin Email</label>
                <input type="email" name="admin_email" class="form-control" value="{{ old('admin_email', $settings['admin_email']) }}" required>
            </div>
    
            <div class="col-md-3 mb-3">
                <label>Contact Number</label>
                <input type="text" name="contact_number" class="form-control" value="{{ old('contact_number', $settings['contact_number']) }}">
            </div>
            <div class="col-md-3 mb-3">
                <label>Logo</label><br>
                @if($settings['logo'])
                    <img src="{{ asset('storage/' . $settings['logo']) }}" alt="Logo" height="60" class="mb-2">
                @endif
                <input type="file" name="logo" class="form-control">
            </div>
    
            <div class="col-md-6 mb-3">
                <label>Address</label>
                <textarea name="address" class="form-control">{{ old('address', $settings['address']) }}</textarea>
            </div>
    
            <div class="col-md-6 mb-3">
                <div class="form-check form-switch">
                    <input type="checkbox" name="maintenance_mode" value="1" class="form-check-input" id="maintenanceSwitch"
                        {{ $settings['maintenance_mode'] ? 'checked' : '' }}>
                    <label class="form-check-label fs-4" for="maintenanceSwitch">Maintenance Mode</label>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save Settings</button>
    </form>
</div>
@endsection
