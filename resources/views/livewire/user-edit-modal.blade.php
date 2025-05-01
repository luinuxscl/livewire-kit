<div>
    <flux:modal name="edit-user" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Edit User') }}</flux:heading>
            </div>

            <flux:input :label="__('Name')" placeholder="Your name" wire:model="name" />

            <flux:input :label="__('Email')" placeholder="Your email" wire:model="email" />

            <flux:select wire:model="role" :placeholder="__('Select a role')">
                @foreach($roles as $rol)
                    <flux:select.option :value="$rol">{{ ucfirst($rol) }}</flux:select.option>
                @endforeach
            </flux:select>

            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Cancel') }}</flux:button>
                </flux:modal.close>
                <flux:button type="button" variant="primary" wire:click="updateUser">{{ __('Save') }}</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
