<div class="flex justify-end">
    @if(!in_array($row->name, ['root', 'admin']))
        <div class="flex gap-2">
            <flux:tooltip :content="__('Delete')" position="left">
                <flux:button
                    size="xs"
                    variant="danger"
                    class="cursor-pointer"
                    x-data
                    x-on:click="$dispatch('openDeleteRoleModal', { roleId: {{ $row->id }} }); $flux.modal('delete-role').show();"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                        <path d="M6.5 1.75A.75.75 0 0 1 7.25 1h1.5a.75.75 0 0 1 .75.75V2.5h3a.75.75 0 0 1 0 1.5h-.278l-.427 7.256A2.75 2.75 0 0 1 9.052 13.5H6.948a2.75 2.75 0 0 1-2.743-2.244L3.778 4H3.5a.75.75 0 0 1 0-1.5h3V1.75ZM5.28 4l.42 7.14a1.25 1.25 0 0 0 1.248 1.11h2.104a1.25 1.25 0 0 0 1.248-1.11L10.72 4H5.28Z" />
                    </svg>
                </flux:button>
            </flux:tooltip> 
            <flux:tooltip :content="__('Edit')" position="left">
                <flux:button
                    size="xs"
                    class="cursor-pointer"
                    x-data
                    x-on:click="$dispatch('openEditRoleModal', { roleId: {{ $row->id }} }); $flux.modal('edit-role').show();"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                        <path d="M13.488 2.513a1.75 1.75 0 0 0-2.475 0L6.75 6.774a2.75 2.75 0 0 0-.596.892l-.848 2.047a.75.75 0 0 0 .98.98l2.047-.848a2.75 2.75 0 0 0 .892-.596l4.261-4.262a1.75 1.75 0 0 0 0-2.474Z" />
                        <path d="M4.75 3.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h6.5c.69 0 1.25-.56 1.25-1.25V9A.75.75 0 0 1 14 9v2.25A2.75 2.75 0 0 1 11.25 14h-6.5A2.75 2.75 0 0 1 2 11.25v-6.5A2.75 2.75 0 0 1 4.75 2H7a.75.75 0 0 1 0 1.5H4.75Z" />
                    </svg>
                </flux:button>
            </flux:tooltip>
                   
        </div>
    @else
        <span class="text-xs text-gray-400 me-2">
            <flux:tooltip :content="__('Role system')" position="left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                </svg>              
            </flux:tooltip>
        </span>
    @endif
</div>
