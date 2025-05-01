<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserCreateModal extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $role = '';
    public $roles = [];
    public $isOpen = false;

    protected $listeners = [
        'openCreateUserModal' => 'openCreateUserModal',
        'closeCreateUserModal' => 'closeCreateUserModal',
    ];

    public function mount()
    {
        $this->roles = Role::pluck('name')->toArray();
    }

    public function openCreateUserModal()
    {
        $this->reset(['name', 'email', 'password', 'password_confirmation', 'role']);
        $this->isOpen = true;
    }

    public function closeCreateUserModal()
    {
        $this->isOpen = false;
        \Flux::modal('create-user')->close();
    }

    public function createUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
            'role' => 'required|string',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        if ($this->role) {
            $user->syncRoles([$this->role]);
        }

        $this->dispatch('userCreated');
        $this->closeCreateUserModal();
    }

    public function render()
    {
        return view('livewire.user-create-modal');
    }
}
