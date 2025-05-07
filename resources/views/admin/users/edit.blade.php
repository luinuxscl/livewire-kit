<x-layouts.likeplatform :title="$user->name" :subtitle="$user->getRoleNames()->first()" icon="contact">
    <x-slot name="buttons">
        <flux:tooltip :content="__('Users')" position="top">
            <flux:button icon="users" variant="primary" :href="route('admin.users.index')" />
        </flux:tooltip>

        <flux:tooltip content="Edit" position="top">
            <flux:button icon="user-pen" />
        </flux:tooltip>
    </x-slot>

    <div class="grid grid-cols-4 gap-4">
        <livewire:admin.user-details :user="$user" />
        <div class="col-span-3">
            <livewire:admin.user-edit :userId="$user->id" />
        </div>
    </div>
</x-layouts.likeplatform>