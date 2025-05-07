<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class UserEdit extends Component
{
    public int $userId;
    public User $user;

    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $address;
    public $bio;

    public function mount(int $userId)
    {
        $this->userId = $userId;
        $this->user = User::findOrFail($userId);
        $this->first_name = $this->user->profile->first_name;
        $this->last_name = $this->user->profile->last_name;
        $this->email = $this->user->email;
        $this->phone = $this->user->profile->phone;
        $this->address = $this->user->profile->address;
        $this->bio = $this->user->profile->bio;
    }

    public function render()
    {
        return view('livewire.admin.user-edit');
    }

    public function update()
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'phone' => 'nullable',
            'address' => 'nullable',
            'bio' => 'nullable',
        ]);

        $this->user->profile->first_name = $this->first_name;
        $this->user->profile->last_name = $this->last_name;
        $this->user->email = $this->email;
        $this->user->profile->phone = $this->phone;
        $this->user->profile->address = $this->address;
        $this->user->name = $this->first_name . ' ' . $this->last_name;
        $this->user->profile->bio = $this->bio;

        $this->user->save();
        $this->user->profile->save();

        $this->dispatch('showToast', [
            'type' => 'success',
            'message' => __('User updated successfully')
        ]);

        $this->dispatch('refreshUser', $this->userId);
    }
}
