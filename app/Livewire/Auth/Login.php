<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password, 'is_active' => true], $this->remember)) {
            session()->regenerate();
            
            if (Auth::user()->isAdmin()) {
                return redirect()->intended('/admin');
            }
            
            return redirect()->intended('/');
        }

        // Check if user exists but inactive
        $user = \App\Models\User::where('email', $this->email)->first();
        if ($user && !$user->is_active) {
            throw ValidationException::withMessages([
                'email' => 'Akun Anda sedang dinonaktifkan.',
            ]);
        }

        throw ValidationException::withMessages([
            'email' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ]);
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('layouts.guest');
    }
}
