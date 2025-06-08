<?php

namespace App\Livewire;

use Livewire\Component;

class SeedProcessSteps extends Component
{
    public $currentStep = 1;
    public $working = false;

    public $steps = [
        ['label' => 'Inicio', 'desc' => 'Esperando inicio del proceso'],
        ['label' => 'Proceso en N8N', 'desc' => 'Automatización en ejecución'],
        ['label' => 'Seed Creada', 'desc' => 'La seed fue generada exitosamente'],
        ['label' => 'Seed Utilizada', 'desc' => 'La seed fue usada en destino'],
    ];

    protected $listeners = [
        'seed-process:advance' => 'nextStep',
        'seed-process:working' => 'setWorking',
        'seed-process:set' => 'setStep',
    ];

    public function nextStep()
    {
        if ($this->currentStep < count($this->steps)) {
            $this->currentStep++;
            $this->working = false;
        }
    }

    public function setStep($step)
    {
        if ($step >= 1 && $step <= count($this->steps)) {
            $this->currentStep = $step;
            $this->working = false;
        }
    }

    public function setWorking($bool = true)
    {
        $this->working = (bool) $bool;
    }

    public function startWorking()
    {
        $this->working = true;
    }

    public function stopWorking()
    {
        $this->working = false;
    }

    public function render()
    {
        return view('livewire.seed-process-steps');
    }
}
