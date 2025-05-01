<div class="fixed top-4 right-4 z-50 space-y-2 max-w-sm w-full">
    @foreach($toasts as $toast)
        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4"
            class="flex items-center px-4 py-3 rounded shadow-lg bg-white dark:bg-zinc-800 border-l-4 mb-2
                @if($toast['type'] === 'success') border-green-500 text-green-800 dark:text-green-300 @endif
                @if($toast['type'] === 'error') border-red-500 text-red-800 dark:text-red-300 @endif
                @if($toast['type'] === 'info') border-blue-500 text-blue-800 dark:text-blue-300 @endif
                @if($toast['type'] === 'warning') border-yellow-500 text-yellow-800 dark:text-yellow-300 @endif"
            role="alert"
            id="{{ $toast['id'] }}"
        >
            <span class="mr-2">
                @if($toast['type'] === 'success')
                    <!-- Success icon -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                @elseif($toast['type'] === 'error')
                    <!-- Error icon -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                @elseif($toast['type'] === 'info')
                    <!-- Info icon -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01"/></svg>
                @elseif($toast['type'] === 'warning')
                    <!-- Warning icon -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M4.93 19h14.14a2 2 0 0 0 1.74-2.97l-7.07-12.14a2 2 0 0 0-3.48 0L3.19 16.03A2 2 0 0 0 4.93 19z"/></svg>
                @endif
            </span>
            <span class="flex-1 dark:text-white">{{ $toast['message'] }}</span>
            <button @click="show = false; $wire.removeToast('{{ $toast['id'] }}')" class="ml-2 text-gray-400 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 focus:outline-none" aria-label="Close">
                &times;
            </button>
        </div>
    @endforeach
</div>
<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('autoCloseToast', ({ id, timeout }) => {
            setTimeout(() => {
                const toast = document.getElementById(id);
                if (toast) {
                    toast.querySelector('button').click();
                }
            }, timeout);
        });
    });
</script>
