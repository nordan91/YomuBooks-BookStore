@extends('layouts.auth', ['title' => 'Register - YomuBooks'])

@section('content')
<div class="auth-header">
    <h4>Join YomuBooks!</h4>
    <p>Create your account and start discovering stories</p>
</div>

<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <div class="input-group">
            <i class="bi bi-person input-icon"></i>
            <input type="text" 
                   class="form-control input-with-icon @error('name') is-invalid @enderror" 
                   id="name" 
                   name="name" 
                   placeholder="Enter your full name" 
                   value="{{ old('name') }}" 
                   required 
                   autofocus>
        </div>
        @error('name')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <div class="input-group">
            <i class="bi bi-envelope input-icon"></i>
            <input type="email" 
                   class="form-control input-with-icon @error('email') is-invalid @enderror" 
                   id="email" 
                   name="email" 
                   placeholder="Enter your email" 
                   value="{{ old('email') }}" 
                   required>
        </div>
        @error('email')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <div class="input-group">
            <i class="bi bi-lock input-icon"></i>
            <input type="password" 
                   class="form-control input-with-icon @error('password') is-invalid @enderror" 
                   id="password" 
                   name="password" 
                   placeholder="Create a password" 
                   required>
        </div>
        @error('password')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <div class="input-group">
            <i class="bi bi-lock-fill input-icon"></i>
            <input type="password" 
                   class="form-control input-with-icon" 
                   id="password_confirmation" 
                   name="password_confirmation" 
                   placeholder="Confirm your password" 
                   required>
        </div>
    </div>

    <div class="d-grid mb-3">
        <button type="submit" class="btn btn-primary btn-lg">
            <i class="bi bi-person-plus me-2"></i>Create Account
        </button>
    </div>

    <div class="auth-footer">
        <p>Already have an account? <a href="{{ route('login') }}">Sign in here</a></p>
    </div>
</form>
@endsection