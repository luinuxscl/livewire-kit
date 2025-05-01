<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserDeleteModal extends Component
{
    public $userId;
    public $userEmail = '';
    public $confirmEmail = '';
    public $isOpen = false;

    protected $listeners = [
        'openDeleteUserModal' => 'openDeleteUserModal',
    ];

    public function openDeleteUserModal($userId)
    {
        $user = User::findOrFail($userId);
        // Solo root puede eliminar root
        if ($user->hasRole('root') && !auth()->user()->hasRole('root')) {
            session()->flash('error', __('Solo un usuario root puede eliminar a otro root.'));
            return;
        }
        // Solo admin o root pueden eliminar usuarios
        if (!auth()->user()->hasAnyRole(['admin', 'root'])) {
            session()->flash('error', __('No tienes permisos para eliminar usuarios.'));
            return;
        }
        $this->userId = $userId;
        $this->userEmail = $user->email;
        $this->confirmEmail = '';
        \Flux::modal('delete-user')->show();
    }

    public function closeDeleteUserModal()
    {
        $this->reset(['userId', 'userEmail', 'confirmEmail']);
        \Flux::modal('delete-user')->close();
    }

    public function deleteUser()
    {
        $user = User::findOrFail($this->userId);
        if ($user->hasRole('root') && !auth()->user()->hasRole('root')) {
            session()->flash('error', __('Solo un usuario root puede eliminar a otro root.'));
            return;
        }
        if (!auth()->user()->hasAnyRole(['admin', 'root'])) {
            session()->flash('error', __('No tienes permisos para eliminar usuarios.'));
            return;
        }
        if ($this->confirmEmail !== $user->email) {
            session()->flash('error', __('El correo no coincide. Escribe el correo exacto para confirmar.'));
            return;
        }
        $user->delete();
        $this->dispatch('userDeleted')->to('user-table');
        $this->closeDeleteUserModal();
    }

    public function render()
    {
        return view('livewire.user-delete-modal');
    }
}
