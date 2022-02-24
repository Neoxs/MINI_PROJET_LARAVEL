<?php

namespace App\Http\Controllers\Util;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function new_book(){
        return view('forms.book');
    }

    public function add_book_to_db(Request $request){
        
        $this->validate($request, [
            // An ISBN number has a minimum of 13 characters
            // including the hyphen and maximum of 17 characters
            // including the hyphen...
            'isbn' => ['required', 'min:13', 'max:17'],
            'title' => 'required',
            'author' => 'required',
            'price' => 'required'

        ]);

        $book_insert = Book::create([
            'isbn_no' => $request->isbn,
            'name' => $request->title,
            'author' => $request->author,
            'price' => $request->price
        ]);

        if(!$book_insert)
            return back()->with('status', 'Something went wrong, book insertion failed!');

        return back()->with('status', 'Book inserted successfully!');
    }
}
