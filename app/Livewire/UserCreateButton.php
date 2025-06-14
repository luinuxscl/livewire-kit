<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserCreateButton extends Component
{
    public function render()
    {
        $user = Auth::user();
        $show = $user && ($user->hasRole('admin') || $user->hasRole('root'));
        return view('livewire.user-create-button', compact('show'));
    }
}
