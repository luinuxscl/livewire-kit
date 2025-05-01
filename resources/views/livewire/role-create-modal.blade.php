<div>
    <flux:modal name="create-role" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Crear rol') }}</flux:heading>
            </div>
            <form wire:submit.prevent="createRole" class="space-y-4">
                <flux:input :label="__('Nombre del rol')" placeholder="Ej: admin" wire:model="name" required />
                <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                    <flux:modal.close>
                        <flux:button variant="filled">{{ __('Cancelar') }}</flux:button>
                    </flux:modal.close>
                    <flux:button type="submit" variant="primary">{{ __('Crear') }}</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>
</div>
