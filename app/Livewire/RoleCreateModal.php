<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleCreateModal extends Component
{
    public $name = '';
    public $isOpen = false;

    protected $listeners = [
        'openCreateRoleModal' => 'openCreateRoleModal',
        'closeCreateRoleModal' => 'closeCreateRoleModal',
    ];

    public function openCreateRoleModal()
    {
        $this->reset(['name']);
        $this->isOpen = true;
    }

    public function closeCreateRoleModal()
    {
        $this->isOpen = false;
        \Flux::modal('create-role')->close();
    }

    public function createRole()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:roles,name',
        ]);
        Role::create(['name' => $this->name, 'guard_name' => 'web']);
        $this->dispatch('roleCreated');
        $this->closeCreateRoleModal();
    }

    public function render()
    {
        return view('livewire.role-create-modal');
    }
}
