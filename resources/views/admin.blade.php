@extends('layouts.app')

@section('title', 'Admin Profile | PawTulong')

@section('content')
<div class="main-bg">
    <div class="container">
        <div class="profile-box">
            <div class="profile-header">
                <i class="fas fa-user-circle"></i>
                <div>
                    <div class="profile-name">{{ auth()->user()->username }}</div>
                    <a href="mailto:{{ auth()->user()->email }}" class="profile-email">{{ auth()->user()->email }}</a>
                </div>
            </div>
            <div class="profile-details">
                <div>
                    <div>Name</div>
                    <div>Email account</div>
                    <div>User Type</div>
                    <div>Account Created</div>
                </div>
                <div>
                    <div>{{ auth()->user()->username }}</div>
                    <div><a href="mailto:{{ auth()->user()->email }}">{{ auth()->user()->email }}</a></div>
                    <div>{{ ucfirst(auth()->user()->user_type) }}</div>
                    <div>{{ auth()->user()->created_at->format('M d, Y') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/admin.js') }}"></script>
@endpush
