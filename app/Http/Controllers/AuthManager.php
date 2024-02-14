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
            return redirect('/profile/{id}/update');
        } else {
            return view('login');
        }
    }

    function loginPost(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ],[
            'email.required' => 'Email is required',
            'email.email' => 'Email is not valid',
            'password.required' => 'Password is required'
        ]);

        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            return redirect(route('profile', ['id' => auth()->user()->id]));
        }
        return redirect(route('login'))->with("error", "Login details are not valid");
    }
    
    function register(){
        if (Auth::check()) {
            return redirect('/profile');
        } else {
            return view('login');
        }
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'registerName' => 'required|regex:/^\S+$/',
            'registerEmail' => 'required|email|unique:users,email',
            'registerPassword' => 'required'
        ] , [
            'registerName.required' => 'Name is required',
            'registerName.regex' => 'Name is not valid',
            'registerEmail.required' => 'Email is required',
            'registerEmail.email' => 'Email is not valid',
            'registerEmail.unique' => 'Email is already registered',
            'registerPassword.required' => 'Password is required'
        ]);

        $user = new User();
        $user->name = $request->input('registerName');
        $user->email = $request->input('registerEmail');
        $user->password = Hash::make($request->input('registerPassword'));

        $user->save();

        if(!$user){
            return redirect(route('register'))->with("error", "Registration Failed. Please Try Again.");
        }
        return redirect(route('register.post'))->with("success", "Registration Successful. Please Login.");
        
    }

    public function profile($id)
    {
        $user = User::find($id);
        return view('userprofile', compact('user'));
    }
    


    public function updateDetails(Request $request, $id)
    {
        $user = User::find($id);
    
        $request->validate([
            'updateName' => 'required|regex:/^\S+$/',
            'newEmail' => 'required|email|unique:users,email',
            'newPassword' => 'required'
        ], [
            'updateName.required' => 'Name is required',
            'updateName.regex' => 'Name is not valid',
            'newEmail.required' => 'Email is required',
            'newEmail.email' => 'Email is not valid',
            'newEmail.unique' => 'Email is already registered',
            'newPassword.required' => 'Password is required'
        
        ]);
        if (!Hash::check($request->input('currentPassword'), $user->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }
    
        $user->name = $request->input('updateName');
        $user->email = $request->input('newEmail');

        if ($request->filled('newPassword')) {
            $user->password = Hash::make($request->input('newPassword'));
        }
    
        $user->save();
        return view('profile', compact('user'))->with('success', 'Profile updated successfully');
    }
    
    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
