<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){

        // Redirects the user to the dashboard page if auth state is true
        if(auth()->user())
            return redirect()->route('dashboard');
        
        return view('forms.login');
    }

    public function auth_user(Request $request){
        
        $this->validate($request, [
            'email' => ['required','email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($request->only('email', 'password'))){
            return redirect()->route('dashboard');
        } else {
            return back()->with('status', 'Username or password is incorrect!');
        }

    }
}
