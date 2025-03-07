@extends('layouts.app')

@section('title', 'Login Page')
@push('css')
    @vite(['resources/css/register.css'])
@endpush
@push('js')
    @vite(['resources/js/authentication.js'])
@endpush
@section('content')
    <div class="register-container">
        <h2>Register</h2>
        <form method="post" action="{{ route('register') }}">
            @csrf
            <div class="input-grp">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="input-grp">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="input-grp">
                <label for="password">Password</label>
                <div class="password-wrapper" >
                    <input type="password" id="password" name="password" required>
                    <button type="button" id="togglePassword">
                        <img src="{{ asset('storage/images/show.png') }}" id="toggleIcon" alt="Show Password" width="20">
                    </button>
                </div>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="input-grp">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            <button type="submit" class="register-btn">Register</button>
        </form>
        <p class="login-link">Already have an account? <a href='/login'>Login here</a></p>
    </div>
@endsection

