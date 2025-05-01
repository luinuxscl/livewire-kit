<div>
    <flux:modal name="create-user" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Create User') }}</flux:heading>
            </div>

            <form wire:submit.prevent="createUser" class="space-y-4">
                <flux:input :label="__('Name')" placeholder="Nombre completo" wire:model="name" required />
                <flux:input :label="__('Email')" placeholder="Correo electrónico" wire:model="email" type="email" required />
                <flux:input :label="__('Password')" placeholder="Contraseña" wire:model="password" type="password" required />
                <flux:input :label="__('Confirm password')" placeholder="Confirma la contraseña" wire:model="password_confirmation" type="password" required />
                <flux:select wire:model="role" :placeholder="__('Select a role')" required>
                    @foreach($roles as $rol)
                        <flux:select.option :value="$rol">{{ ucfirst($rol) }}</flux:select.option>
                    @endforeach
                </flux:select>

                <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                    <flux:modal.close>
                        <flux:button variant="filled">{{ __('Cancel') }}</flux:button>
                    </flux:modal.close>
                    <flux:button type="submit" variant="primary">{{ __('Create') }}</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>
</div>
