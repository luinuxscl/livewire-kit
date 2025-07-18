<flux:dropdown placement="bottom-end" class="ml-1">
    <button class="h-10 w-10 flex items-center justify-center rounded-md hover:bg-zinc-100 dark:hover:bg-zinc-800 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
            <path d="M7.75 2.75a.75.75 0 0 0-1.5 0v1.258a32.987 32.987 0 0 0-3.599.278.75.75 0 1 0 .198 1.487A31.545 31.545 0 0 1 8.7 5.545 19.381 19.381 0 0 1 7 9.56a19.418 19.418 0 0 1-1.002-2.05.75.75 0 0 0-1.384.577 20.935 20.935 0 0 0 1.492 2.91 19.613 19.613 0 0 1-3.828 4.154.75.75 0 1 0 .945 1.164A21.116 21.116 0 0 0 7 12.331c.095.132.192.262.29.391a.75.75 0 0 0 1.194-.91c-.204-.266-.4-.538-.59-.815a20.888 20.888 0 0 0 2.333-5.332c.31.031.618.068.924.108a.75.75 0 0 0 .198-1.487 32.832 32.832 0 0 0-3.599-.278V2.75Z" />
            <path fill-rule="evenodd" d="M13 8a.75.75 0 0 1 .671.415l4.25 8.5a.75.75 0 1 1-1.342.67L15.787 16h-5.573l-.793 1.585a.75.75 0 1 1-1.342-.67l4.25-8.5A.75.75 0 0 1 13 8Zm2.037 6.5L13 10.427 10.964 14.5h4.073Z" clip-rule="evenodd" />
        </svg>
    </button>
    <flux:menu>
        <flux:menu.item as="button"
            wire:click="switch('es')"
            :class="$current === 'es' ? 'bg-zinc-200 dark:bg-zinc-700 font-bold' : ''">
            Español (ES)
        </flux:menu.item>
        <flux:menu.item as="button"
            wire:click="switch('en')"
            :class="$current === 'en' ? 'bg-zinc-200 dark:bg-zinc-700 font-bold' : ''">
            English (EN)
        </flux:menu.item>
    </flux:menu>
</flux:dropdown>
