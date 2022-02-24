@extends('layouts.app')
@section('root')
    <div class="login container row">
        <div class="container left col">
            <h1>
                Let your imagination run wild!
            </h1>
            <img src="{{asset('img/illustrations/login_illustration.svg')}}" alt="" class="illustration">
        </div>
        <form action="{{ route('auth_user') }}" method="POST" class="container right col">
            @csrf
            <h1 class = "text_center_flex">
                Login
            </h1>
            <div class="container col">
                @if (session('status'))
                    <p class="error">
                        {{ session('status') }}
                    </p>
                @endif
                <label for="email">
                    Email
                    <br>
                    <input type="email" name="email" id="email" placeholder="Your email address" value="{{old('email')}}">
                    @error('email')
                        <p class="error">
                            {{ $message }}
                        </p>
                    @enderror
                </label>
                <label for="password">
                    Password
                    <br>
                    <input type="password" name="password" id="password" placeholder="Your password" value="{{old('password')}}">
                    @error('password')
                        <p class="error">
                            {{ $message }}
                        </p>
                    @enderror
                </label>
            </div>
            <button type="submit">
                Login
            </button>
            <a href="{{ route('register') }}"> I don't have an account yet! </a>
        </form>
    </div>
@endsection