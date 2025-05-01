<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleDeleteModal extends Component
{
    public $roleId;
    public $roleName = '';
    public $confirmName = '';
    public $isOpen = false;

    protected $listeners = [
        'openDeleteRoleModal' => 'openDeleteRoleModal',
        'closeDeleteRoleModal' => 'closeDeleteRoleModal',
    ];

    public function openDeleteRoleModal($roleId)
    {
        $role = Role::findOrFail($roleId);
        if (in_array($role->name, ['admin', 'root'])) {
            session()->flash('error', __('No puedes eliminar roles de sistema.'));
            return;
        }
        $this->roleId = $roleId;
        $this->roleName = $role->name;
        $this->confirmName = '';
        $this->isOpen = true;
    }

    public function closeDeleteRoleModal()
    {
        $this->isOpen = false;
        $this->reset(['roleId', 'roleName', 'confirmName']);
        \Flux::modal('delete-role')->close();
    }

    public function deleteRole()
    {
        $role = Role::findOrFail($this->roleId);
        if (in_array($role->name, ['admin', 'root'])) {
            session()->flash('error', __('No puedes eliminar roles de sistema.'));
            return;
        }
        if ($this->confirmName !== $role->name) {
            session()->flash('error', __('El nombre no coincide. Escribe el nombre exacto para confirmar.'));
            return;
        }
        $role->delete();
        $this->dispatch('roleUpdated');
        $this->closeDeleteRoleModal();
    }

    public function render()
    {
        return view('livewire.role-delete-modal');
    }
}
