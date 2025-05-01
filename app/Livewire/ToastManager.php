<?php

namespace App\Livewire;

use Livewire\Component;

class ToastManager extends Component
{
    public $toasts = [];
    
    protected $listeners = [
        'showToast' => 'addToast',
        'removeToast' => 'removeToast',
    ];

    public function mount()
    {
        // Capturar toast desde sesión (útil para redirects desde controladores)
        if (session()->has('toast')) {
            $this->addToast(session()->get('toast'));
        }
        
        // Restaurar toasts persistentes de la sesión (error/warning)
        $this->toasts = session()->pull('persistent_toasts', []);
    }

    public function addToast(...$args)
    {
        // Compatibilidad: aceptar array asociativo o argumentos posicionales
        if (count($args) === 1) {
            if (is_array($args[0])) {
                // Caso 1: array asociativo {type: ..., message: ...}
                $type = $args[0]['type'] ?? 'info';
                $message = $args[0]['message'] ?? '';
            } else {
                // Caso 2: solo tipo string sin mensaje
                $type = $args[0];
                $message = '';
            }
        } elseif (count($args) >= 2) {
            // Caso 3: tipo y mensaje como argumentos separados
            $type = $args[0];
            $message = $args[1];
        } else {
            // Caso 4: sin argumentos (fallback)
            $type = 'info';
            $message = '';
        }
        $id = uniqid('toast_', true);
        $persist = in_array($type, ['error', 'warning']);
        $duration = $persist ? null : 8000;
        $toastData = [
            'id' => $id,
            'type' => $type,
            'message' => $message,
            'persist' => $persist,
            'duration' => $duration,
            'created_at' => now(),
        ];
        $this->toasts[] = $toastData;
        // Guardar persistentes en sesión
        if ($persist) {
            session()->put('persistent_toasts', $this->getPersistentToasts());
        }
        // Si no es persistente, programar cierre automático
        if (!$persist && $duration) {
            $this->dispatch('autoCloseToast', id: $id, timeout: $duration);
        }
    }

    public function removeToast($id)
    {
        $this->toasts = array_values(array_filter($this->toasts, fn($t) => $t['id'] !== $id));
        // Actualizar sesión si quedan persistentes
        session()->put('persistent_toasts', $this->getPersistentToasts());
    }

    private function getPersistentToasts()
    {
        return array_values(array_filter($this->toasts, fn($t) => $t['persist']));
    }

    public function render()
    {
        return view('livewire.toast-manager');
    }
}
