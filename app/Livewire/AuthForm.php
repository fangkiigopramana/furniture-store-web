<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class AuthForm extends Component
{
    public $email = '';
 
    public $password = '';
 
    public function save()
    {
        dd('masuk ini');
        User::create(
            $this->only(['username', 'email', 'password'])
        );
 
        session()->flash('status', 'Post successfully updated.');
 
        return $this->redirect('/home');
    }

    public function render()
    {
        return view('auth.form');
    }
}
