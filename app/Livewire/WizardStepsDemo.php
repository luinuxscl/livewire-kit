<?php

namespace App\Livewire;

use Livewire\Component;

class WizardStepsDemo extends Component
{
    public $current = 1;

    public $steps = [
        ['label' => 'Datos personales', 'desc' => 'Completa tu información básica'],
        ['label' => 'Dirección', 'desc' => 'Agrega tu dirección de envío'],
        ['label' => 'Pago', 'desc' => 'Selecciona método de pago'],
        ['label' => 'Confirmación', 'desc' => 'Revisa y confirma tu pedido'],
    ];

    public function goToStep($step)
    {
        $this->current = $step;
    }

    public function nextStep()
    {
        if ($this->current < count($this->steps)) {
            $this->current++;
        }
    }

    public function prevStep()
    {
        if ($this->current > 1) {
            $this->current--;
        }
    }

    public function render()
    {
        return view('livewire.wizard-steps-demo');
    }
}
