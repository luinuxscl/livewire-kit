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

        $user = \App\Models\User::find($this->userId);
        $currentUser = auth()->user();
        $userIsRoot = $user && $user->hasRole('root');
        $currentIsRoot = $currentUser && $currentUser->hasRole('root');
        $currentIsAdmin = $currentUser && $currentUser->hasRole('admin');

        // Solo root puede editar a root
        if ($userIsRoot && !$currentIsRoot) {
            session()->flash('error', __('Solo un usuario root puede editar a otro root.'));
            $this->closeEditUserModal();
            return;
        }
        // Solo admin/root pueden editar usuarios
        if (!$currentIsRoot && !$currentIsAdmin) {
            session()->flash('error', __('No tienes permisos para editar usuarios.'));
            $this->closeEditUserModal();
            return;
        }
        if ($user) {
            $this->name = $user->name;
            $this->email = $user->email;
            $this->role = $user->getRoleNames()->first() ?? '';
        }
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
        $currentUser = auth()->user();
        $userIsRoot = $user && $user->hasRole('root');
        $currentIsRoot = $currentUser && $currentUser->hasRole('root');
        $currentIsAdmin = $currentUser && $currentUser->hasRole('admin');

        // Solo root puede editar a root
        if ($userIsRoot && !$currentIsRoot) {
            session()->flash('error', __('Only a root user can edit another root user.'));
            $this->closeEditUserModal();
            return;
        }
        // Solo admin/root pueden editar usuarios
        if (!$currentIsRoot && !$currentIsAdmin) {
            session()->flash('error', __('You do not have permission to edit users.'));
            $this->closeEditUserModal();
            return;
        }
        // An admin cannot change the role of a root user
        if ($userIsRoot && $currentIsAdmin && $this->role !== 'root') {
            session()->flash('error', __('An admin cannot demote a root user.'));
            $this->closeEditUserModal();
            return;
        }
        // A root user cannot demote themselves
        if ($userIsRoot && $currentIsRoot && $user->id === $currentUser->id && $this->role !== 'root') {
            session()->flash('error', __('You cannot demote your own root user.'));
            $this->closeEditUserModal();
            return;
        }
        if ($user) {
            $user->name = $this->name;
            $user->email = $this->email;
            $user->save();
            if ($this->role) {
                $user->syncRoles([$this->role]);
            }
            $this->dispatch('editUserUpdated');
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
