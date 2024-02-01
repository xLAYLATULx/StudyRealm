<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthManager extends Controller
{
    function login(){
        if (Auth::check()) {
            return redirect('/profile');
        } else {
            return view('login');
        }
    }

    function loginPost(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            return redirect()->intended(route('login.post'));
        }
        return redirect(route('login'))->with("error", "Login details are not valid");
    }
    
    function register(){
        if (Auth::check()) {
            return redirect('/profile');
        } else {
            return view('register');
        }
    }

    function registerPost(Request $request){
        $request->validate([
            'name' => 'required|regex:/^\S+$/',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        $user = User::create($data);
        if(!$user){
            return redirect(route('register'))->with("error", "Registration Failed. Please Try Again.");
        }
        return redirect(route('register.post'))->with("success", "Registration Successful. Please Login.");
        
    }

    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
