<div>
    <flux:modal name="delete-role" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Eliminar rol') }}</flux:heading>
                <flux:subheading>
                    {{ __('¿Estás seguro de que deseas eliminar el rol') }}
                    <span class="font-bold">{{ $roleName }}</span>?
                    <br>
                    {{ __('Esta acción es irreversible.') }}
                </flux:subheading>
            </div>
            
            <form wire:submit.prevent="deleteRole" class="space-y-4">
                <flux:input
                    :label="__('Escribe el nombre del rol para confirmar')"
                    placeholder="{{ $roleName }}"
                    wire:model="confirmName"
                    required
                />
                <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                    <flux:modal.close>
                        <flux:button variant="filled">{{ __('Cancelar') }}</flux:button>
                    </flux:modal.close>
                    <flux:button type="submit" variant="danger">
                        {{ __('Eliminar') }}
                    </flux:button>
                    @if($confirmName && $confirmName !== $roleName)
                        <div class="text-xs text-red-500 mt-2">
                            {{ __('El nombre no coincide. Escribe el nombre exacto para confirmar.') }}
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </flux:modal>
</div>
