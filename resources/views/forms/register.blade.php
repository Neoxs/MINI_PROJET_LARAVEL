@extends('layouts.app')
@section('root')
    <div class="register container row">
    <form action="{{ route('new_user') }}" method="POST" class="container left col">
            @csrf
            <h1 class = "text_center_flex">
                Register
            </h1>
            <div class="container col">
                @if (session('status'))
                    <p class="error">
                        {{ session('status') }}
                    </p>
                @endif
                <label for="name">
                    Name
                    <br>
                    <input type="text" name="name" id="name" placeholder="Your fullname" value="{{old('name')}}">
                    @error('name')
                        <p class="error">
                            {{ $message }}
                        </p>
                    @enderror
                </label>
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
                <label for="password_confirmation">
                    Confirm password
                    <br>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm password" value="{{old('password_confirmation')}}">
                    @error('password_confirmation')
                        <p class="error">
                            {{ $message }}
                        </p>
                    @enderror
                </label>
            </div>
            <button type="submit">
                Register
            </button>
            <a href="{{ route('login') }}"> I already have an account! </a>
        </form>
        <div class="container right col">
            <img src="{{asset('img/illustrations/registration_illustration.svg')}}" alt="" class="illustration">
            <h1>
                We're glad to have you on-board!
            </h1>
        </div>
    </div>
@endsection