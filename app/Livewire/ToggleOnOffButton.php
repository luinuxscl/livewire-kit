<?php

declare(strict_types=1);

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Log;

/**
 * Componente de interruptor (toggle) que puede cambiar entre estados activo/inactivo
 *
 * @property bool $isActive Estado actual del interruptor
 * @property string|null $eventName Nombre opcional del evento a despachar al cambiar el estado
 */
class ToggleOnOffButton extends Component
{
    /**
     * Estado actual del interruptor
     *
     * @var bool
     */
    public bool $isActive = false;

    /**
     * Nombre opcional del evento a despachar al cambiar el estado
     *
     * @var string|null
     */
    public ?string $eventName = null;

    /**
     * Inicializa el componente
     *
     * @param bool $isActive Estado inicial del interruptor
     * @param string|null $eventName Nombre opcional del evento a despachar
     */
    public function mount(bool $isActive = false, ?string $eventName = null): void
    {
        $this->isActive = $isActive;
        $this->eventName = $eventName;
    }

    /**
     * Renderiza la vista del componente
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.toggle-on-off-button');
    }

    /**
     * Alterna el estado del interruptor y despacha el evento si está configurado
     *
     * @return void
     */
    public function toggle(): void
    {
        $this->isActive = !$this->isActive;
        $text = $this->isActive ? 'true' : 'false';
        Log::info('desde ToggleOnOffButton sale: ' . $text);
        $this->dispatchToggleEvent();
    }

    /**
     * Establece el estado activo del interruptor
     *
     * @param bool $isActive Nuevo estado del interruptor
     * @return void
     */
    #[On('on-off-button-set-active-state')]
    public function setActiveState(bool $isActive): void
    {
        if ($this->isActive !== $isActive) {
            $this->isActive = $isActive;
            $this->dispatchToggleEvent();
        }
    }

    /**
     * Despacha el evento de cambio de estado si está configurado
     *
     * @return void
     */
    private function dispatchToggleEvent(): void
    {
        if ($this->eventName) {
            $this->dispatch($this->eventName, $this->isActive);
        }
    }
}
