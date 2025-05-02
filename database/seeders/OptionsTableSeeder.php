<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Option;

class OptionsTableSeeder extends Seeder
{
    public function run()
    {
        Option::setValue('site_logo_light', null, 'string', 'branding', true);
        Option::setValue('site_logo_dark', null, 'string', 'branding', true);
        Option::setValue('site_title', "LikePlatform Kit", 'string', 'general', true);
        Option::setValue('site_description', "Laravel 12 + Livewire 3 + Tailwind CSS 4", 'text', 'general', true);
        Option::setValue('site_icon', null, 'string', 'branding', true);
        Option::setValue('contact_email', "likeplatform.cl@gmail.com", 'string', 'general', true);
        Option::setValue('default_locale', "es", 'string', 'localization', true);
        Option::setValue('default_timezone', "America/Santiago", 'string', 'localization', true);
        Option::setValue('registration_enabled', true, 'boolean', 'general', true);
    }
}
