@extends('layouts.app')
@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5 fw-bold">Our Services</h1>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=600&auto=format&fit=crop&q=60" class="card-img-top" alt="Booking">
                <div class="card-body text-center">
                    <h5 class="card-title">Travel Booking</h5>
                    <p class="card-text">Seamless booking for domestic and international trips with real-time availability.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=600&auto=format&fit=crop&q=60" class="card-img-top" alt="Packages">
                <div class="card-body text-center">
                    <h5 class="card-title">Custom Packages</h5>
                    <p class="card-text">Tailor-made packages to suit your travel preferences and budget.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <img src="https://images.unsplash.com/photo-1480714378408-67cf0d13bc1b?w=600&auto=format&fit=crop&q=60" class="card-img-top" alt="Support">
                <div class="card-body text-center">
                    <h5 class="card-title">24/7 Support</h5>
                    <p class="card-text">Our team is available round the clock to assist you with bookings and queries.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection