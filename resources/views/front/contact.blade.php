@extends('layouts.app')
@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5 fw-bold">Get in Touch</h1>

    <div class="row g-4">
        <!-- Contact Form -->
        <div class="col-md-6">
            <div class="card shadow-lg border-0 p-4" style="border-radius: 1rem; background: linear-gradient(135deg,#6e8efb,#a777e3); color:#fff;">
                <h4 class="mb-4">Send us a Message</h4>
                <form id="contact-form">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-lg" id="name" placeholder="Your Name" required>
                        <label for="name">Full Name</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control form-control-lg" id="email" placeholder="Your Email" required>
                        <label for="email">Email Address</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-lg" id="subject" placeholder="Subject" required>
                        <label for="subject">Subject</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control form-control-lg" id="message" placeholder="Your Message" style="height:120px" required></textarea>
                        <label for="message">Message</label>
                    </div>

                    <button type="submit" class="btn btn-light btn-lg w-100 shadow-sm" style="color:#6e8efb;">Send Message</button>
                </form>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="col-md-6">
            <div class="card shadow-lg border-0 p-4" style="border-radius: 1rem;">
                <h4 class="mb-4 text-primary">Contact Information</h4>
                <ul class="list-unstyled fs-6">
                    <li class="mb-3 d-flex align-items-center">
                        <span class="me-3 fs-4 text-primary">📍</span>
                        <span>123 Travel Street, Wanderlust City, India</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <span class="me-3 fs-4 text-primary">📞</span>
                        <span>+91 12345 67890</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <span class="me-3 fs-4 text-primary">✉️</span>
                        <span>support@travelms.com</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <span class="me-3 fs-4 text-primary">🌐</span>
                        <span>www.travelms.com</span>
                    </li>
                </ul>

                <!-- Optional map placeholder -->
                <div class="mt-4" style="height:250px; background:#e9ecef; border-radius:0.5rem; display:flex; align-items:center; justify-content:center; color:#6c757d;">
                    Map Placeholder
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('contact-form')?.addEventListener('submit', function(e){
    e.preventDefault();
    // You can integrate with your backend here
    alert('Thank you! Your message has been sent.');
});
</script>
@endsection