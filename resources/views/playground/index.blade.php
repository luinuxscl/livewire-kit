<x-layouts.likeplatform :title="__('Playground')" icon="bolt">
    <x-slot name="buttons">
        <flux:tooltip content="Refresh" position="top">
            <flux:button icon="refresh-ccw-dot" :href="url('playground')" />
        </flux:tooltip>
    </x-slot>
    {{-- INFO:Poner ejemplos de componentes desde aqui --}}

    {{-- Crear un grid de tres columnas --}}
    <div class="grid grid-cols-3 gap-4">
        <x-ui.profile-widget />
        <x-ui.profile-widget :user="\App\Models\User::find(2)" />
        <x-ui.profile-widget :user="\App\Models\User::find(3)" />
        <x-ui.profile-widget :user="\App\Models\User::find(4)" />
        <x-ui.profile-widget :user="\App\Models\User::find(5)" :showProfile="false" />
        <x-ui.profile-widget :user="\App\Models\User::find(6)" />
        <x-ui.profile-widget :user="\App\Models\User::find(7)" :showProfile="false" />
    </div>

    <x-ui.examples.cards />

    <flux:separator class="my-6" />

    <x-ui.card title="{{ __('Ejemplos de Toast') }}">
        <div class="grid grid-cols-4 gap-8">
            <flux:button class="w-full btn btn-success" onclick="Livewire.dispatch('showToast', {type: 'success', message: '{{ __('This is a success toast!') }}'})">Toast succces</flux:button>
            <flux:button class="w-full btn btn-info" onclick="Livewire.dispatch('showToast', {type: 'info', message: '{{ __('This is an info toast!') }}'})">Toast info</flux:button>
            <flux:button class="w-full btn btn-warning" onclick="Livewire.dispatch('showToast', {type: 'warning', message: '{{ __('This is a warning toast!') }}'})">Toast warning</flux:button>
            <flux:button class="w-full btn btn-danger" onclick="Livewire.dispatch('showToast', {type: 'error', message: '{{ __('This is an error toast!') }}'})">Toast error</flux:button>
        </div>
    </x-ui.card>
</x-layouts.likeplatform>
