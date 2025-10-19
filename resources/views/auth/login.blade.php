@extends('layouts.app')

@section('title', 'Login')

@php
    $layoutCss = 'login.css';
    $layoutJs = 'login.js';
@endphp

@section('content')
<div class="container">
    <div class="login-box">
        <h1>Login</h1>

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

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">LOGIN</button>
        </form>

        <div class="signup-link">
            Not yet a member? <a href="{{ route('register.form') }}">Sign Up</a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/login.js') }}"></script>
@endpush
