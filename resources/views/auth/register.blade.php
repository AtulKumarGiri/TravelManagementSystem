<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Travel Management System</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;900&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
        }

        .register-card {
            width: 500px;
            background: linear-gradient(145deg, #ffffff, #f7f7f7);
            border-radius: 1rem;
            padding: 3rem 2.5rem;
            box-shadow: 0 12px 25px rgba(0,0,0,0.25);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .register-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 18px 30px rgba(0,0,0,0.35);
        }

        .register-card h2 {
            font-weight: 900;
            text-align: center;
            margin-bottom: 0.5rem;
            color: #4a00e0;
        }

        .register-card p {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #6c757d;
            font-weight: 500;
        }

        .form-control:focus {
            box-shadow: 0 0 8px rgba(74, 0, 224, 0.5);
            border-color: #4a00e0;
        }

        .btn-register {
            background: linear-gradient(90deg, #6a11cb, #2575fc);
            color: white;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            background: linear-gradient(90deg, #2575fc, #6a11cb);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.25);
        }

        .text-link {
            color: #4a00e0;
            text-decoration: none;
            font-weight: 600;
        }

        .text-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="register-card">
    <h2>Register</h2>
    <p>Create your account to manage bookings and packages</p>

    <form method="POST" action="">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <input type="text" 
                   class="form-control @error('name') is-invalid @enderror" 
                   name="name" 
                   placeholder="Full Name" 
                   value="{{ old('name') }}" 
                   required autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <input type="email" 
                   class="form-control @error('email') is-invalid @enderror" 
                   name="email" 
                   placeholder="Email Address" 
                   value="{{ old('email') }}" 
                   required>
            @error('email')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <input type="password" 
                   class="form-control @error('password') is-invalid @enderror" 
                   name="password" 
                   placeholder="Password" 
                   required>
            @error('password')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <input type="password" 
                   class="form-control" 
                   name="password_confirmation" 
                   placeholder="Confirm Password" 
                   required>
        </div>

        <!-- Role Selector -->
        <div class="mb-4">
            <select class="form-select @error('role') is-invalid @enderror" name="role" required>
                <option value="">Select Role</option>
                <option value="partner" {{ old('role')=='partner'?'selected':'' }}>Partner</option>
                <option value="supplier" {{ old('role')=='supplier'?'selected':'' }}>Supplier</option>
                <option value="customer" {{ old('role')=='customer'?'selected':'' }}>Customer</option>
            </select>
            @error('role')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <!-- Register Button -->
        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-register btn-lg">Register</button>
        </div>

        <!-- Login Link -->
        <div class="text-center">
            <a href="{{ route('login') }}" class="text-link">Already have an account? Login</a>
        </div>
    </form>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
