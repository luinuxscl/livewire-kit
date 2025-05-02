<footer
    class="border-t border-zinc-200 bg-zinc-50 text-zinc-600
    dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-400 py-4">
    <div class="mx-auto w-full h-full [:where(&)]:max-w-7xl px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-2 text-sm">
        <div>
            &copy; {{ date('Y') }} Livewire Kit. {{ __('All rights reserved.') }}
        </div>
        <div class="flex gap-2">
            <a href="https://github.com/luinuxscl/livewire-kit" target="_blank"
                class="hover:underline flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                GitHub
            </a>
            <span>|</span>
            <a href="https://github.com/luinuxscl/livewire-kit/tree/develop/docs" target="_blank"
                class="hover:underline flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20h9" />
                </svg>
                Docs
            </a>
            @role(['admin', 'root'])
                <span class="ms-4">
                    <x-github />
                </span>
            @endrole
        </div>
    </div>
</footer>
