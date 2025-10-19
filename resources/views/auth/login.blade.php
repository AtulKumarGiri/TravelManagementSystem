@extends('layouts.app')

@section('content')
<style>
    body, html { height: 100%; margin:0; font-family: 'Nunito', sans-serif; }
    .bg-animated { position: fixed; width:100%; height:100%; background: linear-gradient(135deg, {{ $colors['start'] }}, {{ $colors['end'] }}); background-size: 400% 400%; animation: gradientBG 15s ease infinite; z-index:-1; }
    @keyframes gradientBG { 0%{background-position:0% 50%}50%{background-position:100% 50%}100%{background-position:0% 50%} }
    .login-card { background: rgba(255,255,255,0.95); backdrop-filter: blur(15px); border-radius:20px; padding:40px; width:400px; max-width:90%; box-shadow:0 10px 40px rgba(0,0,0,0.25); text-align:center; position:relative; z-index:1; animation: fadeIn 1.2s ease forwards; }
    @keyframes fadeIn {0%{opacity:0; transform:translateY(-20px);}100%{opacity:1; transform:translateY(0);} }
    .btn-gradient { background: linear-gradient(to right, {{ $colors['button_start'] }}, {{ $colors['button_end'] }}); color:#fff; font-weight:600; border:none; transition: all 0.3s ease; }
    .btn-gradient:hover { opacity:0.9; }
</style>

<div class="bg-animated"></div>
<div style="display:flex; justify-content:center; align-items:center; height:100vh;">
    <div class="login-card text-dark">
        <h2 class="mb-4">{{ ucfirst($role) }} Login</h2>
        @if($errors->any())
            <div style="color:red;margin-bottom:15px;">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('login.submit') }}">
            @csrf
            <input type="hidden" name="role" value="{{ $role }}">
            <div style="margin-bottom:15px;">
                <input type="email" name="email" placeholder="Email" class="form-control text-dark" required>
            </div>
            <div style="margin-bottom:15px;">
                <input type="password" name="password" placeholder="Password" class="form-control text-dark" required>
            </div>
            <button type="submit" class="btn btn-gradient w-100">Login</button>
        </form>
    </div>
</div>
@endsection
