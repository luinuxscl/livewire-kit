<?php

namespace App\Livewire;

use Livewire\Component;

use Spatie\Permission\Models\Role;

class UserEditModal extends Component
{
    public $userId = null;
    public $name = '';
    public $email = '';
    public $role = '';
    public $roles = [];
    public $isOpen = false;

    protected $listeners = [
        'closeEditUserModal' => 'closeEditUserModal',
        'editUserUpdated' => '$refresh',
        'openEditUserModal' => 'openEditUserModal',
    ];
    public function openEditUserModal($userId)
    {
        $this->userId = $userId;
        $this->isOpen = true;

        // Fetch user data from the server
        $user = \App\Models\User::find($this->userId);
        if ($user) {
            $this->name = $user->name;
            $this->email = $user->email;
            $this->role = $user->getRoleNames()->first() ?? '';
        }
        
        // No necesitamos activar el modal explícitamente aquí,
        // ya que se activará a través del evento Alpine.js desde el botón
    }
    public function closeEditUserModal()
    {
        $this->isOpen = false;
        $this->reset(['userId', 'name', 'email', 'role']);
        
        // Cerrar el modal usando FluxUI
        \Flux::modal('edit-user')->close();
    }
    public function updateUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->userId,
            'role' => 'required|string',
        ]);

        $user = \App\Models\User::find($this->userId);
        if ($user) {
            // Actualizando los datos del usuario
            $user->name = $this->name;
            $user->email = $this->email;
            $user->save();
            // Asignar el rol único
            if ($this->role) {
                $user->syncRoles([$this->role]);
            }
            
            // Notificar que se ha actualizado el usuario
            $this->dispatch('editUserUpdated');
            
            // Cerrar el modal
            $this->closeEditUserModal();
        }
    }
    // Eliminamos la función de borrado de usuarios
    // public function deleteUser()
    // {
    //     // Funcionalidad eliminada según requerimiento
    // }
    public function mount()
    {
        // Cargar todos los roles disponibles
        $this->roles = \Spatie\Permission\Models\Role::pluck('name')->toArray();
    }

    public function render()
    {
        return view('livewire.user-edit-modal');
    }
}
