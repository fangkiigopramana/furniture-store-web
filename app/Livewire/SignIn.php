<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Rule;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class SignIn extends Component
{
    #[Rule('required|email')]
    public $email = '';

    #[Rule('required')]
    public string $password = '';

    public function validation()
    {

        if (Auth::attempt($this->validate())) {
            Alert::success('Success', 'Login Successfully');
            return redirect('/');
        }

        throw ValidationException::withMessages([
            'email' => "The provided credential do not match our record",
        ]);

    }

    public function signout(){
        auth()->logout();
        return redirect()->route('login');
    }

    public function render()
    {

        return view('auth.form', [
            'title' => 'Sign In'
        ]);
    }
}