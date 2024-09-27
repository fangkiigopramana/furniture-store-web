<?php

namespace App\Livewire;

use App\Models\User;
use App\Services\FurnitureAPIService;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class SignUp extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $role = '';
 
    public function save()
    {
        $validatedData = $this->validate([
            'name' => 'required|min:6',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|string|in:Buyer,Seller',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);
        $user->assignRole($validatedData['role']);
        $user->save();
        Alert::success('Success', 'Sign Up Berhasil');
    
        return $this->redirect('/sign-in', true);
    }

    public function render()
    {
        return view('auth.form',[
            'title' => 'Sign Up'
        ]);
    }
}
