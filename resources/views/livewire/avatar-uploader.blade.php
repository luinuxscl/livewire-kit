<div>
    
    <div class="mt-4 flex items-center gap-4">
        @if (auth()->user()->profile->avatar)
        <flux:avatar 
        :src="Storage::url(auth()->user()->profile->avatar)" 
        :name="auth()->user()->name"
        size="xl" />
        @else
        <flux:avatar 
        :name="auth()->user()->name"
        size="xl"
        color="auto" />
        @endif
        
        <div class="flex gap-4">
            
            @if (auth()->user()->profile->avatar)
            <flux:button wire:click="delete" size="xs" class="mt-2 ml-2" class="cursor-pointer" variant="danger">
                <flux:icon icon="trash" variant="mini" />
            </flux:button>
            @else
            <flux:input 
            type="file" 
            wire:model="avatar" 
            accept="image/*"
             />

            <flux:button wire:click="save" class="mt-2 ml-2" class="cursor-pointer" variant="primary" icon="image-up">
                {{ __('Upload') }}
            </flux:button>
            @endif
        </div>
        @error('avatar') <flux:text color="red">{{ $message }}</flux:text> @enderror
    </div>
</div>
