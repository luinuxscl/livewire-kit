<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Option;
use Illuminate\Support\Facades\Auth;

/**
 * Componente para personalización de la aplicación.
 */
class AppCustomization extends Component
{
    // Logos manejados por ImageCardUploader subcomponentes
    public $title;
    public $description;
    public $icon;
    public $email;
    public $locale;
    public $timezone;
    public $registrationEnabled;

    public function mount()
    {
        $this->title = Option::getValue('site_title');
        $this->description = Option::getValue('site_description');
        $this->icon = Option::getValue('site_icon');
        $this->email = Option::getValue('contact_email');
        $this->locale = Option::getValue('default_locale');
        $this->timezone = Option::getValue('default_timezone');
        $this->registrationEnabled = Option::getValue('registration_enabled', false);
    }

    /**
     * Guarda la configuración en la base de datos.
     */
    public function save()
    {
        $this->validate([
            'title'               => 'required|string',
            'description'         => 'nullable|string',
            'icon'                => 'nullable|string',
            'email'               => 'required|email',
            'locale'              => 'required|string',
            'timezone'            => 'required|string',
            'registrationEnabled' => 'boolean',
        ]);

        $userId = Auth::id();

        Option::setValue('site_title',          $this->title,               'string', 'general',      true, $userId);
        Option::setValue('site_description',    $this->description,         'text',   'general',      true, $userId);
        Option::setValue('site_icon',           $this->icon,                'string', 'branding',     true, $userId);
        Option::setValue('contact_email',       $this->email,               'string', 'general',      true, $userId);
        Option::setValue('default_locale',      $this->locale,              'string', 'localization', true, $userId);
        Option::setValue('default_timezone',    $this->timezone,            'string', 'localization', true, $userId);
        Option::setValue('registration_enabled', $this->registrationEnabled, 'boolean','general',      true, $userId);

        $this->dispatch('showToast', ['type' => 'success', 'message' => __('Configuración guardada')]);
    }

    public function render()
    {
        return view('livewire.app-customization');
    }
}
