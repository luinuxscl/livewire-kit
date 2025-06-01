<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<section class="mx-auto w-full h-full [:where(&)]:max-w-7xl px-6 lg:px-8">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('API Tokens')" :subheading=" __('Manage your API tokens')">
        <livewire:api-token-manager />
    </x-settings.layout>
</section>
