@extends('layouts.app')
@section('root')
    <div class="book container row">
        <div class="container left col">
            <h1>
                “There is nothing new except what has been forgotten.”
                <br>
                ― Marie Antoinette
            </h1>
        </div>
        <form action="{{ route('push_to_db') }}" method="POST" class="container right col">
            @csrf
            <h1>
                New Book
            </h1>
            @if(session('status'))
                <p>
                    {{session('status')}}
                </p>
            @endif
            <div class="container col">
                @error('status')
                    <p class="error">
                        {{status}}
                    </p>   
                @enderror
                <label for="isbn">
                    ISBN NO
                    <br>
                    <input type="text" name="isbn" id="isbn" placeholder="New ISBN NO" value="{{old('isbn')}}">
                    @error('isbn')
                        <p class="error">
                            {{ $message }}
                        </p>
                    @enderror
                </label>
                <label for="title">
                    Title
                    <br>
                    <input type="text" name="title" id="title" placeholder="New book title" value="{{old('title')}}">
                    @error('title')
                        <p class="error">
                            {{ $message }}
                        </p>
                    @enderror
                </label>
                <label for="author">
                    Author
                    <br>
                    <input type="author" name="author" id="author" placeholder="New book's author" value="{{old('author')}}">
                    @error('author')
                        <p class="error">
                            {{ $message }}
                        </p>
                    @enderror
                </label>
                <label for="price">
                    Price
                    <br>
                    <input type="number" name="price" id="price" placeholder="New book's price" value="{{old('price')}}">
                    @error('price')
                        <p class="error">
                            {{ $message }}
                        </p>
                    @enderror
                </label>
            </div>
            <button type="submit">
                Submit
            </button>
        </form>
    </div>
@endsection