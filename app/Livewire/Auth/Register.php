<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{
    public $name = '';
    public $email = '';
    public $phone = '';
    public $address = '';
    public $password = '';
    public $password_confirmation = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'phone' => 'required|string|max:20',
        'address' => 'required|string',
        'password' => 'required|string|min:8|confirmed',
    ];

    public function register()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'password' => Hash::make($this->password),
            'role' => 'customer',
            'is_active' => true,
        ]);

        $user->notify(new \App\Notifications\WelcomeNotification());

        Auth::login($user);

        return redirect()->intended('/');
    }

    public function render()
    {
        return view('livewire.auth.register')->layout('layouts.guest');
    }
}
