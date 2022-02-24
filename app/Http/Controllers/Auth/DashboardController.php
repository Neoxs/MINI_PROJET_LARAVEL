<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        // Redirects the user to the login page if auth state is false
        if(!auth()->user())        
            return redirect()->route('login'); 
        
        $books = Book::get();

        return view('dashboard.dashboard', [
            'books' => $books
        ]);
    }

    public function search(Request $request){

        if(!auth()->user())        
            return redirect()->route('login'); 

        $this->validate($request, [
            'query' => 'required'
        ]);

        $search_for = $request->only('query');


        $book = Book::where('name', $search_for)->get();
        
        return view('dashboard.dashboard', [
            'books' => $book
        ]);
    }

    // Pretty spaghetti, but I'm tired :C
    public function view_book($id){
        
        if(!auth()->user())        
            return redirect()->route('login'); 
        
        $books = Book::get();

        $book_info = Book::where('id', $id)->get();


        if(!$books)
            return redirect()->route('dashboard'); 
        elseif($book_info->count() == 0)
            return redirect()->route('dashboard'); 

        return view('dashboard.dashboard', [
            'books' => $books,
            'info' => $book_info
        ]);
    }

    public function remove_book($id){
        
        if(!auth()->user())        
            return redirect()->route('login'); 

        $delete = Book::where('id', $id)->delete();

        if(!$delete)
            return response()->json([
                'status' => false
            ]);

        return response()->json([
            'status' => true
        ]);
    }

    public function edit($id){
        if(!auth()->user())        
            return redirect()->route('login'); 

        $book = Book::where('id', $id)->get();

        if(!$book)
            return response()->json([
                'status' => false
            ]);

        return response()->json([
            'status' => true,
            'book' => $book
        ]);
    }

    public function to_edit(Request $request, $id){
        if(!auth()->user())
            return redirect()->route('login');

            $this->validate($request, [
                // An ISBN number has a minimum of 13 characters
                // including the hyphen and maximum of 17 characters
                // including the hyphen...
                'isbn' => ['required', 'min:13', 'max:17'],
                'title' => 'required',
                'author' => 'required',
                'price' => ['required', 'numeric']
            ]);

        $book_to_update = Book::where('id', $id)->update([
            'isbn_no' => $request->isbn,
            'name' => $request->title,
            'author' => $request->author,
            'price' => $request->price
        ]);

        if(!$book_to_update)
            return response()->json([
                'status' => false
            ]); 

        return response()->json([
            'status' => true
        ]);
    }

}
