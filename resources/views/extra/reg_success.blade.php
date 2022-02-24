@extends('layouts.app')
@section('root')
    <div class="container col fhw">
        <h1 class="text_center_flex">
            Registration is successful!
        </h1>
        <a href="{{ route('login') }}" style="color: var(--color3)">
            Go back to Login
        </a>
    </div>
@endsection