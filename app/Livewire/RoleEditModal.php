<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleEditModal extends Component
{
    public $roleId;
    public $name = '';
    public $isOpen = false;

    protected $listeners = [
        'openEditRoleModal' => 'openEditRoleModal',
        'closeEditRoleModal' => 'closeEditRoleModal',
    ];

    public function openEditRoleModal($roleId)
    {
        $role = Role::findOrFail($roleId);
        if (in_array($role->name, ['admin', 'root'])) {
            // No permitir edición de roles de sistema
            session()->flash('error', __('No puedes editar roles de sistema.'));
            return;
        }
        $this->roleId = $roleId;
        $this->name = $role->name;
        $this->isOpen = true;
    }

    public function closeEditRoleModal()
    {
        $this->isOpen = false;
        $this->reset(['roleId', 'name']);
        \Flux::modal('edit-role')->close();
    }

    public function updateRole()
    {
        $role = Role::findOrFail($this->roleId);
        if (in_array($role->name, ['admin', 'root'])) {
            session()->flash('error', __('No puedes editar roles de sistema.'));
            return;
        }
        $this->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $this->roleId,
        ]);
        $role->name = $this->name;
        $role->save();
        $this->dispatch('roleUpdated');
        $this->closeEditRoleModal();
    }

    public function render()
    {
        return view('livewire.role-edit-modal');
    }
}
