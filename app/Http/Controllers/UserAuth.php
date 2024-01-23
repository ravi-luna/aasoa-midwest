<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserAuth extends Controller
{

    // load view page of register
    public function register(){
        return view("register");
    }

    // load view page of login
    public function login(){
        return view("login");
    }

    // Function for validate registration form
    public function validate_registration(Request $request)
    {
        $data = $request->all();
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email|max:255',
            'phone_number' => 'required|numeric|digits:10',
            'password'      => 'required|string|min:6'
        ]);

        // dd($request->all());
        User::create([
            'name'  =>  $data['name'],
            'email' =>  $data['email'],
            'phone_number' =>  $data['phone_number'],
            'password' => Hash::make($data['password'])
        ]);

        return redirect('/')->with('success', 'Registration Completed, now you can login');
    }

    // Function for validate login form
    public function validate_login(Request $request)
    {
        // dd('dfds');
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // dd($credentials);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::check()) {
                return redirect()->intended('index');
            } else {
                // Authentication failed for some reason
                return redirect()->route('login')->with('error', 'Authentication failed.');
            }
        }

        return back()->withErrors([
            'email_id' => 'The provided credentials do not match our records.',
        ]);
    }

    // Function for validate logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
