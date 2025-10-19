<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>We'll Be Back Soon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            color: #343a40;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 500px;
        }
        .logo {
            max-width: 120px;
            margin-bottom: 20px;
        }
        h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }
        p {
            font-size: 18px;
        }
        .btn-home {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        @php
            // Get logo from settings (fallback to public logo)
            $logo = \App\Models\Setting::where('key','logo')->value('value') ?? 'logo.png';
            // Get admin bypass token
            $token = \App\Models\Setting::where('key','maintenance_bypass_token')->value('value');
        @endphp

        <img src="{{ asset('storage/' . $logo) }}" alt="Logo" class="logo">

        <h1>We'll Be Back Soon</h1>
        <p>Our website is currently undergoing scheduled maintenance.<br>
           Thank you for your patience.</p>

        <a href="{{ url('/') }}" class="btn btn-primary btn-home">Go to Homepage</a>

        @if($token)
            <div class="mt-3">
                <a href="{{ url($token) }}" class="btn btn-outline-secondary" target="_blank">
                    Admin Bypass Link
                </a>
            </div>
        @endif
    </div>
</body>
</html>
