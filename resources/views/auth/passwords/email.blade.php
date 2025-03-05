@extends('layouts.app')

@section('title', 'Forgot Password')

@push('css')
    @vite(['resources/css/auth.css'])
@endpush

@section('content')
<div class="auth-container">
    <h2>Forgot Password</h2>

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="input-grp">
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required>
            @error('email') <p class="invalid-feedback">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="auth-btn">Send Password Reset Link</button>
    </form>

    <a href="{{ route('login') }}" class="auth-links">Back to Login</a>
</div>
@endsection
