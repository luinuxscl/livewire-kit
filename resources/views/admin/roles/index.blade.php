{{-- <x-page :title="__('Roles')">
    <div class="flex items-center justify-between mb-4">
        <div class="flex gap-2">
            <div class="flex pt-1 me-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                </svg>
            </div>
            <div class="flex flex-col">
                <h2 class="text-2xl font-bold text-neutral-900 dark:text-white">{{ __('Roles') }}</h2>
                <p class="text-sm text-neutral-500 dark:text-neutral-400">
                    {{ __('Here you can manage the roles of the platform.') }}
                </p>
            </div>
        </div>
        <flux:button variant="primary" x-data x-on:click="$dispatch('openCreateRoleModal'); $flux.modal('create-role').show();">
            {{ __('New Role') }}
        </flux:button>
    </div>
    <livewire:role-table />
    <livewire:role-create-modal />
    <livewire:role-edit-modal />
    <livewire:role-delete-modal />
</x-page> --}}

<x-layouts.likeplatform :title="__('Roles')" icon="shield-user">
    <x-slot name="header">
        <h1 class="text-2xl font-bold text-neutral-900 dark:text-white">{{ __('Roles') }}</h1>
        <p class="text-sm text-neutral-500 dark:text-neutral-400">
            {{ __('Here you can manage the roles of the platform.') }}
        </p>
    </x-slot>

    <div class="flex items-center justify-between mb-4">
        <flux:button variant="primary" x-data
            x-on:click="$dispatch('openCreateRoleModal'); $flux.modal('create-role').show();">
            {{ __('New Role') }}
        </flux:button>
    </div>

    <livewire:role-table />
    <livewire:role-create-modal />
    <livewire:role-edit-modal />
    <livewire:role-delete-modal />
</x-layouts.likeplatform>
