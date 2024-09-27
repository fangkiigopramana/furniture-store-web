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
        $validator  = $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            Alert::success('Success', 'Sign In Berhasil');
            return $this->redirect('/product-catalog', true);
        }

        return redirect()->back()->withErrors($validator)->withInput();
    }

    public function signout()
    {
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
