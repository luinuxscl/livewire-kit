<div class="bg-white dark:bg-gray-800 shadow rounded overflow-hidden">
    <div class="border-b px-4 py-2">
        <h3 class="font-semibold text-lg">
            {{ \Illuminate\Support\Str::title(str_replace('_', ' ', $field)) }}
        </h3>
    </div>
    <div class="p-4 space-y-4">
        @if($currentValue)
            <img src="{{ Storage::url($currentValue) }}" alt="{{ $field }}" class="w-32 h-32 object-contain mx-auto" />
        @endif

        <div class="flex items-center space-x-2">
            <label for="file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Seleccionar imagen') }}</label>
            <input type="file" id="file" wire:model="file" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
        </div>
        @error('file') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

        <div wire:loading wire:target="file" class="flex items-center space-x-2">
            <svg class="animate-spin h-5 w-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
            <span class="text-gray-700 dark:text-gray-300">{{ __('Subiendo...') }}</span>
        </div>
    </div>
</div>
