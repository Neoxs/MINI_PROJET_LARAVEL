<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(){
        return view('forms.register');
    }

    public function add_new_user(Request $request){
        try {
            $this->validate($request, [
                'name' => ['required', 'max:255'],
                'email' => ['required','email', 'max:255'],
                'password' => ['required', 'confirmed']
            ]);
    
            $insert_user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password) 
            ]);

            if(!$insert_user){
                return back()->with('status', 'Registration failed, something went wrong!');
            }
            // default redirect is a fail splash component
            
            return redirect()->route('reg_success');
        } catch (\Throwable $th) {
            return back()->with('status', ($request->email . ' is already taken'));
        }        
            
    }
}
