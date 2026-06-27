<?php

namespace App\Livewire\Member;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileEdit extends Component
{
    public $name;
    public $email;
    public $phone;
    public $address;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->address = $user->address;
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::id())],
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        Auth::user()->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
        ]);

        session()->flash('message', 'Profil berhasil diperbarui.');
        return redirect()->route('member.profile');
    }

    public function render()
    {
        return view('livewire.member.profile-edit')->layout('layouts.app');
    }
}
