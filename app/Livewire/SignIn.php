<?php

namespace App\Livewire;

use App\Services\FurnitureAPIService;
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
            $service = new FurnitureAPIService();
            $login = $service->login([
                'email' => $this->email,
                'password' => $this->password,
            ]);

            $token = $login['token'];
            session(['token' => $token]);
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