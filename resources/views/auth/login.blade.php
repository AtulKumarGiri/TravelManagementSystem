<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst($role) }} Login - Travel Management System</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, {{ $colors['start'] }}, {{ $colors['end'] }});
        }

        .login-card {
            width: 500px;
            border-radius: 1rem;
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
            padding: 2rem;
            background-color: #fff;
        }

        .login-card h2 {
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .login-card p {
            color: #6c757d;
            margin-bottom: 1.5rem;
        }

        .btn-primary {
            background: linear-gradient(90deg, {{ $colors['button_start'] }}, {{ $colors['button_end'] }});
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, {{ $colors['button_end'] }}, {{ $colors['button_start'] }});
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="text-center mb-4">
            <h2>{{ ucfirst($role) }} Login</h2>
            <p>Enter your credentials to access your dashboard</p>
        </div>

        <form method="POST" action="{{ route($role . '.login.submit') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required autofocus
                       placeholder="{{ $role }}@example.com">
                @error('email')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       id="password" 
                       name="password" 
                       required
                       placeholder="Enter your password">
                @error('password')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    Remember Me
                </label>
            </div>

            <!-- Submit Button -->
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary btn-lg fw-bold">
                    Login
                </button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
