<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'PawTulong')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700;1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/' . ($layoutCss ?? 'landing.css')) }}">
    @if(request()->routeIs('chatbot') || request()->routeIs('chatbot.*'))
    <style>
    html, body {
        overflow: hidden;
    }
    </style>
    @endif
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
</head>

<body>
<div class="main-bg">
    <div class="header">
        <img src="{{ asset('img/logo (1).png') }}" class="logo" alt="Logo">
        <span class="brand">PawTulong</span>

        @auth
        <nav>
            <ul class="nav-links">
                <li>
                    <a href="{{ route('landing') }}" 
                       class="{{ ($page ?? '') === 'home' ? 'active' : '' }}">Home</a>
                </li>
                <li>
                    <a href="{{ route('chatbot') }}" 
                       class="{{ ($page ?? '') === 'chatbot' ? 'active' : '' }}">AI Chatbot</a>
                </li>
                <li>
                    @if(Auth::user()->user_type === 'admin')
                        <a href="{{ route('admin.products') }}" 
                           class="{{ ($page ?? '') === 'products' ? 'active' : '' }}">Products</a>
                    @else
                        <a href="{{ route('products.index') }}" 
                           class="{{ ($page ?? '') === 'products' ? 'active' : '' }}">Products</a>
                    @endif
                </li>

                {{-- Profile link (moved from dropdown) --}}
                <li>
                    <a href="{{ Auth::user()->user_type === 'admin' ? route('admin.dashboard') : route('client.dashboard') }}" 
                       class="{{ ($page ?? '') === 'profile' ? 'active' : '' }}">Profile</a>
                </li>
            </ul>
        </nav>
        @endauth
    </div>

    <div class="container">
        @yield('content')
    </div>
</div>

@if (!request()->routeIs('chatbot') && !request()->routeIs('chatbot.*'))
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
@endif

<script src="{{ asset('js/' . ($layoutJs ?? 'client.js')) }}"></script>
@stack('scripts')
</body>
</html>
