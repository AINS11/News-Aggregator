@extends('layouts.app')

@section('content')
@section('title', 'Reset Password')

@push('css')
    @vite(['resources/css/auth.css'])
@endpush

<div class="auth-container">
    <h2>Reset Password</h2>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="input-grp">
            <label for="email">Email Address:</label>
            
            <input type="email" id="email" name="email" value="<?php echo $_GET['email']?>" required>
            @error('email') <p class="invalid-feedback">{{ $message }}</p> @enderror
        </div>

        <div class="input-grp">
            <label for="password">New Password:</label>
            <input type="password" id="password" name="password" required>
            @error('password') <p class="invalid-feedback">{{ $message }}</p> @enderror
        </div>

        <div class="input-grp">
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <button type="submit" class="auth-btn">Reset Password</button>
    </form>

    <a href="{{ route('login') }}" class="auth-links">Back to Login</a>
</div>
@endsection
