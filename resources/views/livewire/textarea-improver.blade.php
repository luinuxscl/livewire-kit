<div class="">
    <div class="flex">

        <div class="flex-1">
            <flux:textarea
                :label="$label ?? ''"
                :placeholder="$placeholder ?? ''"
                wire:model="text"
                :rows="3"
                class="w-full"
            />
        </div>

        <div class="w-14 flex-none">
            <flux:button icon="sparkles" wire:click="improveText()" size="xs"
            class="cursor-pointer" />
        </div>
    
    </div>

    <div>
        @if($debug && !empty($webhookDebug))
        <div class="mt-4 border border-gray-200 dark:border-gray-700 rounded shadow-sm bg-gray-100 dark:bg-gray-800">
            <div class="px-3 pt-2 pb-1 text-[11px] font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Debug Webhook
            </div>
            <pre class="px-3 pb-2 text-xs font-mono text-gray-800 dark:text-gray-100 bg-transparent whitespace-pre overflow-x-auto">
{{ json_encode($webhookDebug, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}
            </pre>
        </div>
    @endif
    </div>
</div>
