@extends('layouts.app')
@section('root')
@auth
    <div class="dashboard container row">
        <!-- Greetings and Table panel -->
        <div class="container left col">
            <div class="greeting container row fw separate">
                <h1> Hello, {{ auth()->user()->name }} </h1>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit">
                        <img src="{{ asset('img/icons/logoff-icon.svg') }}" alt="" class="icon logout">
                    </button>
                </form>
            </div>
            <form class ="search container col" action=" {{ route('search') }} " method="POST">
                @csrf
                <label for="query" class="search">
                    Search
                    <br>
                    <input  type="text" name="query" id="query" placeholder="Search book by its name" value="{{old('query')}}">
                </label>
            </form>
            <div class="table container col">
                @if($books->count())
                    @foreach ($books as $book)
                    <a href = "{{ route('view_book', $book->id) }}" class="list-item container col" style="cursor: pointer;">
                        <div class="list">
                            <img src="{{ asset('img/icons/book-list-icon.svg') }}" alt="Image of an opened book" class="icon">
                            <p>
                               <strong>Title:   </strong> {{$book->name}}
                            </p>                    
                        </div>
                        <div class="line"></div>
                    </a>
                    @endforeach
                @else
                <h3>
                    Not found! 😫
                </h3>
                @endif
            </div>
        </div>
        <!-- Book info panel -->
        <div class="container right col">
            @if ($info ?? '')    
                @foreach ($info ?? '' as $data)
                    <h1 class="text_center_flex">
                        Book Info:    
                    </h1>
                    <p>
                        <strong>ISBN NO: </strong> {{$data->isbn_no}}
                    </p>
                    <div class="card_group container col fw">
                        <p class="book-id" style="display: none;">
                            {{ $data->id }}
                        </p>
                        <div class="book_card container row">
                            <img src="{{ asset('img/icons/book-title-icon.svg') }}" alt="Image of an opened book" class="icon">
                            <p class="book-title">
                                <strong>Title: </strong> {{ $data->name }}
                            </p>
                        </div>
                        <div class="line"></div>
                        <div class="book_card container row">
                            <img src="{{ asset('img/icons/author-icon.svg') }}" alt="Image of an opened book" class="icon">
                            <p>
                                <strong>Author: </strong> {{ $data->author }}
                            </p>
                        </div>
                        <div class="line"></div>
                        <div class="book_card container row">
                            <img src="{{ asset('img/icons/price-icon.svg') }}" alt="Image of an opened book" class="icon">
                            <p>
                                <strong>Price: </strong> {{ $data->price }}
                            </p>
                        </div>
                        <div class="line"></div>
                        <div class="button-group container row">
                            <form method = "get" class="edit">
                                @csrf
                                <button class="edit-button">
                                    Edit
                                </button>
                            </form>
                            <form method = "get" class="delete">
                                @csrf
                                <button class="delete-button">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
                @else
                    <h1 class="text_center_flex">
                        Pick a book! 😌
                    </h1>
            @endif
        </div>
    </div>
@endauth
@guest    
    <div class="container col fhw">
            <h1 class="text_center_flex">
                Forbidden access!
            </h1>
    </div>
@endguest

@endsection