@extends('layouts.public')

@section('title', 'Welcome | PawTulong')

@section('content')
<main>
    <section class="hero">
        <div class="hero-text">
            <h1>LOVE YOUR<br />PET MORE</h1>
            <p>Your Trusted Partner in Pet Care, Ensuring<br />the Health and Well-Being of Your<br />Beloved Canine and Feline Companions</p>
            <a href="{{ route('login.form') }}" class="btn btn-primary" style="margin: 32px auto 0 auto; display: inline-block; padding: 16px 48px; font-size: 1.1rem; border-radius: 12px; font-weight: 500; background: #6b4a6b; color: #fff; text-decoration: none;">Sign In</a>
        </div>
        
    
        <div class="hero-image">
            <img src="{{ asset('img/8.png') }}" alt="Cute Puppy in Location Marker" />
        </div>
    </section>
</main>
@endsection
