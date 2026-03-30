<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /* Login function to validate user authentication using an auth method and form field validations for the login form. */
    public function login (Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(!Auth::attempt($credentials)){
            return response()->json([
                'message' => "Invalid username or password. please try again"
            ], 401);
        }

        return response()->json([
            'message' => 'Login successful',
            'user' => Auth::user()
        ]);
    }

    /* Function to return the Blade view for the login form. */
    public function showLogin(){
        return view('pharmacovigilance.login');
    }

    public function logout(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        
    }
}
