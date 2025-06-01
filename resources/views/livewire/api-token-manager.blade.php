<div>

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


    <flux:modal name="token-generated" :open="!!$plainTextToken">
        @if($plainTextToken)
            <div class="flex flex-col gap-2" >
                <flux:heading class="text-lg font-semibold mb-4">{{ __('New Token') }}</flux:heading>
                <flux:input icon="key" value="{{ $plainTextToken }}" class="min-w-[400px]" readonly copyable />
            </div>
        @endif
    </flux:modal>

    <div>
        @if($tokens && count($tokens) > 0)
            <livewire:token-table wire:key="token-table-{{ now()->timestamp }}" />
            <flux:button icon="trash" wire:click="revokeAll" variant="danger" class="btn mt-4">
                {{ __('Revoke All') }}
            </flux:button>
        @endif

        <script>
            document.addEventListener('livewire:tokenTableRefresh', function () {
                Livewire.find(document.querySelector('[wire\:key^=token-table]').getAttribute('wire:id')).$refresh();
            });
        </script>
    </div>
</div>
