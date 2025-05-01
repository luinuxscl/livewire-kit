<x-page :title="__('Playground')">

    <div class="flex items-center justify-between">
        <div class="flex gap-2">
            <div class="flex pt-1 me-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m6.75 7.5 3 2.25-3 2.25m4.5 0h3m-9 8.25h13.5A2.25 2.25 0 0 0 21 18V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v12a2.25 2.25 0 0 0 2.25 2.25Z" />
                  </svg>                                    
            </div>
            <div class="flex flex-col">
                <h2 class="text-2xl font-bold text-neutral-900 dark:text-white">{{ __('Playground') }}</h2>
                <p class="text-sm text-neutral-500 dark:text-neutral-400">
                    {{ __('Here you can test components and features.') }}
                </p>
            </div>
        </div>
        <div class="flex justify-end gap-2">
            <flux:button
                :href="route('dashboard')"
                icon:trailing="arrow-turn-down-left"
            >
                {{ __('Go to Dashboard') }}
            </flux:button>
        </div>
        
    </div>
    <div class="grid grid-cols-2 gap-4">
        <button onclick="Livewire.dispatch('showToast', {type: 'success', message: '{{ __('This is a success toast!') }}'})" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">{{ __('Show Success Toast') }}</button>
        <button onclick="Livewire.dispatch('showToast', {type: 'info', message: '{{ __('This is an info toast!') }}'})" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">{{ __('Show Info Toast') }}</button>
        <button onclick="Livewire.dispatch('showToast', {type: 'warning', message: '{{ __('This is a warning toast!') }}'})" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">{{ __('Show Warning Toast') }}</button>
        <button onclick="Livewire.dispatch('showToast', {type: 'error', message: '{{ __('This is an error toast!') }}'})" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">{{ __('Show Error Toast') }}</button>
    </div>
</x-page>
