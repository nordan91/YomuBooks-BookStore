@extends('layouts.auth', ['title' => 'Login - YomuBooks'])

@section('content')
<div class="auth-header">
    <h4>Welcome Back!</h4>
    <p>Sign in to continue your reading journey</p>
</div>

<form method="POST" action="{{ route('login') }}">
    @csrf
    
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
                   required 
                   autofocus>
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
                   placeholder="Enter your password" 
                   required>
        </div>
        @error('password')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    @if (session('status'))
    <div class="alert alert-danger mb-3">
        <i class="bi bi-exclamation-circle me-2"></i>{{ session('status') }}
    </div>
    @endif

    <div class="d-grid mb-3">
        <button type="submit" class="btn btn-primary btn-lg">
            <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
        </button>
    </div>

    <div class="auth-footer">
        <p>Don't have an account? <a href="{{ route('register') }}">Create one now</a></p>
    </div>
</form>
@endsection