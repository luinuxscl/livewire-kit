<div>
    <div class="flex items-center flex-col lg:flex-row gap-2">
        <flux:label for="value" class="w-full lg:w-1/3 text-lg font-semibold">{{ __('likeplatform.'.$name) }}</flux:label>
        <flux:input.group>

            <flux:input 
            :type="$type"
            :placeholder="__('likeplatform.'.$name)" 
                wire:model.live="value" />

            @if($this->hasChanges)
            <flux:button icon="save" variant="primary" class="cursor-pointer" wire:click="saveOption">{{ __('Save changes') }}</flux:button>
            @else
            <flux:button icon="check" variant="ghost" disabled />
            @endif
        </flux:input.group>
    </div>
</div>
