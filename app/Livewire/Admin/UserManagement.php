<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class UserManagement extends Component
{
    public $user;
    public $tab = 1;

    public function mount($user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.admin.user-management');
    }

    public function editTab($tab)
    {
        $this->tab = $tab;
    }
}
