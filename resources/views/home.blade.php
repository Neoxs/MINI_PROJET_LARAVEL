@extends('layouts.app')
@section('root')
<div class="home container col fhw">
    <nav class="navigation container row fw">
        <div class="logo_holder container row">
            <img src="{{ asset('img/icons/lms-icon.svg') }}" alt="" class="icon">
            <p>
                Library Management System - ESI SBA
            </p>
        </div>
        @auth
            <a href="{{ route('dashboard') }}">Proceed to Dashboard</a>
        @endauth
        @guest
            <a href="{{ route('login') }}">Login</a>
        @endguest
    </nav>
    <div class="content container row fw">
        <img src="{{ asset('img/illustrations/home_illustration.svg') }}" alt="" class="illustration">
        <div class="action container col">
            <h2>
                <strong>
                    "The more that you read, the more things you will know. The more that you learn, the more places you'll go.” - Dr. Seuss
                </strong>
            </h2>    
            <a href="{{route('add_new')}}" style="color: var(--color3); text-decoration: none;">
                <button style="margin:auto;">
                I wanna add a book!
                </button>
            </a>
        </div>
    </div>
    <footer class="container row fw">
        <p>
            ESI SBA © 2021
        </p>
        <div class="socials_holder container row">
            <a href="https://www.facebook.com/" target="_blank">
                <img src="{{ asset('img/icons/facebook-icon.svg') }}" alt="">
            </a>
            <a href="https://github.com/lozanasc" target="_blank">
                <img src="{{ asset('img/icons/github-icon.svg') }}" alt="">
            </a>
        </div>
    </footer>
</div>
@endsection
