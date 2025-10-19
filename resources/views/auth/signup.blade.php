@extends('layouts.app')

@section('title', 'Sign Up')

@php
    $layoutCss = 'login.css';
    $layoutJs = 'login.js';
@endphp

@section('content')
<div class="container">
    <div class="login-box signup">
        <h1>Sign Up</h1>

        {{-- Errors --}}
        @if($errors->any())
            <div class="error-message">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        {{-- Success --}}
        @if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('register.store') }}">
            @csrf
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="password_confirmation" required>
            </div>

            <button type="submit">SIGN UP</button>
        </form>

        <div class="signup-link">
            Already have an account? <a href="{{ route('login.form') }}">Log In</a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/signup.js') }}"></script>
@endpush
