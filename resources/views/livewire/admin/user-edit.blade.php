<div>
    <x-ui.card title=" ">
        <x-slot name="actions">
            <flux:button icon="user" size="sm" :href="route('admin.users.show', $user)" class="cursor-pointer me-2" />
            <flux:button icon="save" variant="primary" size="sm" wire:click="update" class="cursor-pointer" />
        </x-slot>
        <div class="grid grid-cols-3 gap-4">
            <div class="flex flex-col gap-1">
                <flux:field>
                    <flux:label>{{ __('First Name') }}</flux:label>
                <flux:input wire:model="first_name" />
                <flux:error name="first_name" />
                </flux:field>
            </div>
            <div class="flex flex-col gap-1">
                <flux:field>
                    <flux:label>{{ __('Last Name') }}</flux:label>
                <flux:input wire:model="last_name" />
                <flux:error name="last_name" />
                </flux:field>
            </div>
            <div class="flex flex-col gap-1">
                <flux:field>
                    <flux:label>{{ __('Email') }}</flux:label>
                <flux:input wire:model="email" />
                <flux:error name="email" />
                </flux:field>
            </div>
            <div class="flex flex-col gap-1">
                <flux:field>
                    <flux:label>{{ __('Phone') }}</flux:label>
                <flux:input wire:model="phone" />
                <flux:error name="phone" />
                </flux:field>
            </div>
            <div class="flex flex-col gap-1 col-span-2">
                <flux:field>
                    <flux:label>{{ __('Address') }}</flux:label>
                <flux:input wire:model="address" />
                <flux:error name="address" />
                </flux:field>
            </div>
            <div class="flex flex-col gap-1 col-span-3">
                <flux:textarea wire:model="bio" label="Bio" placeholder="No bio..." />
                <flux:error name="bio" />
            </div>
        </div>
    </x-ui.card>
</div>
