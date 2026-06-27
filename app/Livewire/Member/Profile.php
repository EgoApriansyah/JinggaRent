<?php

namespace App\Livewire\Member;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class Profile extends Component
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



    public function render()
    {
        return view('livewire.member.profile')->layout('layouts.app');
    }
}
