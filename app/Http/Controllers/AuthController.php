<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;


class AuthController extends Controller
{
    public function login() {
        return view('auth.login');
    }

    public function authenticate(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns|exists:users,email',
            'password' => 'required|min:8',
        ]);
        
        if ($validator->fails()) {
            Alert::error('Login Failed', 'Invalid credentials.');
            return redirect()->back()->withInput();
        }
        
        if (Auth::attempt($validator->validated())) {
            $request->session()->regenerate();
            Alert::success('Success', 'Login Successfully');
            return redirect()->route('home');
        }
        
        Alert::error('Login Failed', 'The provided credentials do not match our records.');
        return back()->withInput();
    }

    public function register() {
        return view('auth.register');
    }

}
