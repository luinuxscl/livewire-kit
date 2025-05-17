<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Option;

class ChangeOption extends Component
{
    public string $name;
    public ?string $value;
    public ?string $type;

    public function mount(string $name, string $type = 'text')
    {
        $this->name = $name;
        $this->value = Option::getValue($name);
        $this->type = $type;
    }

    /**
     * Indica si el valor actual difiere del almacenado en base de datos.
     */
    public function getHasChangesProperty(): bool
    {
        return $this->value !== Option::getValue($this->name);
    }

    /**
     * Guarda el valor de la opción.
     */
    public function saveOption()
    {
        if ($this->type === 'email') {
            $this->validate([
                'value' => 'required|email',
            ]);
        }
        Option::setValue($this->name, $this->value);
        $this->dispatch('showToast', type: 'success', message: __('likeplatform.option_updated'));
    }

    public function render()
    {
        return view('livewire.change-option');
    }
}
