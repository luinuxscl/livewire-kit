<x-layouts.likeplatform :title="$user->name" icon="contact">
    <x-slot name="subtitle">
        <x-ui.role :role="$user->getRoleNames()->first()" />
    </x-slot>
    <x-slot name="buttons">
        <flux:tooltip :content="__('Users')" position="bottom">
            <flux:button icon="users" variant="ghost" class="cursor-pointer" :href="route('admin.users.index')" />
        </flux:tooltip>
    </x-slot>

    <div class="grid grid-cols-4 gap-4">
        <livewire:admin.user-details :user="$user" />
        <div class="col-span-3">
            <livewire:admin.user-management :user="$user" />
        </div>
    </div>
</x-layouts.likeplatform>