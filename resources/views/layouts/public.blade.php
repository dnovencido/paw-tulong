<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'PawTulong')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700;1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    {{-- Load CSS from public/css (reuse landing styles) --}}
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    @stack('head')
    <style>
        /* Ensure footer sticks to bottom without white gaps */
        .main-bg { min-height: 100vh; display: flex; flex-direction: column; }
        .container { flex: 1; }
    </style>
    @stack('styles')
    @yield('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="main-bg">
    <div class="header">
        <img src="{{ asset('img/logo (1).png') }}" class="logo" alt="Logo">
        <span class="brand">PawTulong</span>
        {{-- No top navigation or dropdown on public landing --}}
    </div>

    <div class="container">
        @yield('content')
    </div>
</div>

<footer>
    <div class="footer-content">
        <span>FOLLOW US:</span>
        <a href="https://www.facebook.com/profile.php?id=61570063546853"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-x-twitter"></i></a>
        <a href="#"><i class="fab fa-youtube"></i></a>
        <a href="#"><i class="fas fa-paw"></i></a>
    </div>
    </footer>

{{-- Load default JS --}}
<script src="{{ asset('js/client.js') }}"></script>
@stack('scripts')
@yield('scripts')
</body>
</html>


