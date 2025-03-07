@extends('layouts.app')

@section('title', 'Login Page')
@push('css')
    @vite(['resources/css/login.css'])
@endpush

@push('js')
    @vite(['resources/js/authentication.js'])
@endpush

@section('content')
    <div class="login-container">
        <h2>Login</h2>
        @if(session('status'))
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form method="post" action="{{ route('login') }}">
            @csrf
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
            <button type="submit" class="login-btn">Login</button>
        </form>
        <a href="/forgot-password" class="forgot-password" style="color: #6e8efb">Forgot Password?</a>
        <p class="register-link new-user">Don't have an account? <a href='/register'>Sign up here</a></p>
    </div>
@endsection