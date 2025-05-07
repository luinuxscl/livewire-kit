<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class UserDetails extends Component
{
    public $user;

    protected $listeners = [
        'editUserUpdated' => '$refresh',
        'refreshUser' => '$refresh'
    ];

    public function mount($user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.admin.user-details');
    }
}
