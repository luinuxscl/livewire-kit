<div>
    <div
        x-data="{ show: false, message: '', type: 'success', timeout: null }"
        x-on:notify.window="
            type = $event.detail.type;
            message = $event.detail.message;
            show = true;
            clearTimeout(timeout);
            timeout = setTimeout(() => show = false, 3000);
        "
    >
        <template x-if="show">
            <div class="fixed top-4 right-4 z-50 px-4 py-2 rounded shadow-lg text-white"
                :class="type === 'success' ? 'bg-green-600' : 'bg-yellow-600'">
                <span x-text="message"></span>
            </div>
        </template>
    </div>

    @if( isset($plainTextToken) )
            <div class="flex flex-col gap-2 mb-6">
                <flux:label>{{ __('New token generated:') }}</flux:label>
                <flux:input icon="key" value="{{ $plainTextToken }}" readonly copyable />
            </div>
        @else
        <div class="flex flex-col gap-4 mb-6" >
            <div>
                <flux:field>
                    <flux:label>{{ __('Token Name') }}</flux:label>
                    <flux:input wire:model.defer="device_name" :placeholder="__('Unique name for this token')" />
                </flux:field>
            </div>
    
            <div>
                <flux:label for="expiration">{{ __('Expiration') }}</flux:label>
                <flux:select wire:model="expiration" 
                placeholder="Choose expiration..."
                class="mt-2">
                    <flux:select.option value="7">7 days</flux:select.option>
                    <flux:select.option value="30" selected>30 days</flux:select.option>
                    <flux:select.option value="60">60 days</flux:select.option>
                    <flux:select.option value="90">90 days</flux:select.option>
                    <flux:select.option value="365">365 days</flux:select.option>
                </flux:select>
            </div>
            <div>
                <flux:button wire:click="generateToken" class="btn btn-success">
                    {{ __('Generate Token') }}
                </flux:button>
            </div>
        </div>
       
        @endif

    <div>
        <livewire:token-table/>
        <flux:button icon="trash" wire:click="revokeAll" variant="danger" class="btn mt-4">
            {{ __('Revoke All') }}
        </flux:button>
    </div>
</div>
