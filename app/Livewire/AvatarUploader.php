<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class AvatarUploader extends Component
{
    use WithFileUploads;

    public $avatar;

    public function updatedAvatar()
    {
        $this->validate([
            'avatar' => 'image|max:1024',
        ]);
    }

    public function save()
    {
        $this->validate([
            'avatar' => 'image|max:1024',
        ]);

        $user = auth()->user();
        $old = $user->profile->avatar;
        if ($old) {
            Storage::disk('public')->delete($old);
        }
        $path = $this->avatar->store('avatars', 'public');
        $user->profile->update(['avatar' => $path]);

        $this->avatar = null;
        $this->dispatch('showToast', type: 'success', message: __('Avatar actualizado'));
    }

    public function delete()
    {
        $user = auth()->user();
        $old = $user->profile->avatar;
        if ($old) {
            Storage::disk('public')->delete($old);
            $user->profile->update(['avatar' => null]);
            $this->dispatch('showToast', type: 'success', message: __('Avatar eliminado'));
        }
    }

    public function render()
    {
        return view('livewire.avatar-uploader');
    }
}
