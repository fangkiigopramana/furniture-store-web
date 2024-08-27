<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class SignUp extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
 
    public function save()
    {
        $validatedData = $this->validate([
            'name' => 'required|min:6',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $user = User::create($validatedData);
        $user->assignRole('Buyer');
        $user->save();
    
        Alert::success('Success', 'Sign Up Berhasil');
    
        return $this->redirect('/');
    }

    public function render()
    {
        return view('auth.form',[
            'title' => 'Sign Up'
        ]);
    }
}
