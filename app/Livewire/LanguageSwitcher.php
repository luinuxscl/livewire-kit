<?php
namespace App\Livewire;

use Livewire\Component;

class LanguageSwitcher extends Component
{
    public $current;

    public function mount()
    {
        $this->current = app()->getLocale();
    }

    public function switch($lang)
    {
        \Log::info('LanguageSwitcher: Cambiando idioma a ' . $lang);
        session(['locale' => $lang]);
        $this->current = $lang;
        $this->dispatch('language-switched', $lang);
        $this->dispatch('reload');
    }

    public function render()
    {
        return view('livewire.language-switcher');
    }
}
