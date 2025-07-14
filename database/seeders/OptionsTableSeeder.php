<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Option;

class OptionsTableSeeder extends Seeder
{
    /**
     * Título personalizado del sitio.
     *
     * @var string|null
     */
    protected $siteTitle;

    /**
     * Descripción personalizada del sitio.
     *
     * @var string|null
     */
    protected $siteDescription;

    /**
     * Crear una nueva instancia del seeder.
     *
     * @param string|null $siteTitle
     * @param string|null $siteDescription
     * @return void
     */
    public function __construct($siteTitle = null, $siteDescription = null)
    {
        $this->siteTitle = $siteTitle;
        $this->siteDescription = $siteDescription;
    }

    /**
     * Ejecutar el seeder.
     *
     * @return void
     */
    public function run()
    {
        Option::setValue('site_logo_light', null, 'string', 'branding', true);
        Option::setValue('site_logo_dark', null, 'string', 'branding', true);
        
        // Usar el título personalizado o el valor por defecto
        Option::setValue(
            'site_title', 
            $this->siteTitle ?? 'LikePlatform Kit', 
            'string', 
            'general', 
            true
        );
        
        // Usar la descripción personalizada o el valor por defecto
        Option::setValue(
            'site_description', 
            $this->siteDescription ?? 'Laravel 12 + Livewire 3 + Tailwind CSS 4', 
            'text', 
            'general', 
            true
        );
        
        Option::setValue('site_icon', null, 'string', 'branding', true);
        Option::setValue('contact_email', "likeplatform.cl@gmail.com", 'string', 'general', true);
        Option::setValue('default_locale', "es", 'string', 'localization', true);
        Option::setValue('default_timezone', "America/Santiago", 'string', 'localization', true);
        Option::setValue('registration_enabled', true, 'boolean', 'general', true);
    }
}
