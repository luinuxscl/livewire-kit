<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ApiTokenManager extends Component
{

    public $tokens;
    public $device_name;
    public $plainTextToken;
    public $expiration = 30; // Días por defecto

    public function mount()
    {
        $this->loadTokens();
    }

    public function loadTokens()
    {
        $this->tokens = Auth::user()->tokens()->latest()->get();
    }

    public function generateToken()
    {
        $this->validate([
            'device_name' => 'required|string|max:255',
            'expiration' => 'required|integer|min:1',
        ]);
        $token = Auth::user()->createToken($this->device_name);
        // Guardar la expiración
        $tokenModel = $token->accessToken ?? $token->token;
        if ($tokenModel) {
            $tokenModel->expires_at = now()->addDays((int) $this->expiration);
            $tokenModel->save();
        }
        $this->plainTextToken = $token->plainTextToken;
        $this->device_name = '';
        $this->expiration = 30;
        $this->loadTokens();
        $this->dispatch('notify', type: 'success', message: 'Token generado.');
    }

    public function revoke($id)
    {
        Auth::user()->tokens()->where('id', $id)->delete();
        $this->loadTokens();
        $this->dispatch('notify', type: 'warning', message: 'Token revocado.');
    }

    public function revokeAll()
    {
        Auth::user()->tokens()->delete();
        $this->loadTokens();
        $this->dispatch('notify', type: 'warning', message: 'Todos los tokens revocados.');
    }

    public function render()
    {
        return view('livewire.api-token-manager');
    }
}
