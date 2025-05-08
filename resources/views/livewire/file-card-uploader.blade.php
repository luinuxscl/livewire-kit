<x-ui.card title="{{ $title }}">
        @if($currentPath)
        <flux:link :href="Storage::url($currentPath)" target="_blank">Ver archivo actual</flux:link>
        @endif

        <flux:input type="file" wire:model="file" accept="{{ $accept }}"/>
        @error('file') <flux:text color="red">{{ $message }}</flux:text> @enderror

        <div wire:loading wire:target="file" class="flex items-center space-x-2">
            <svg class="animate-spin h-5 w-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
            <span class="text-gray-700 dark:text-gray-300">{{ __('Uploading...') }}</span>
        </div>
</x-ui.card>