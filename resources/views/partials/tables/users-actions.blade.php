<div class="flex justify-end gap-2">
    <flux:tooltip :content="__('Edit')" position="left">
        <flux:button
            size="xs"
            class="cursor-pointer"
            x-data
            x-on:click="$dispatch('openEditUserModal', { userId: {{ $row->id }} }); $flux.modal('edit-user').show();"
        >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                <path d="M13.488 2.513a1.75 1.75 0 0 0-2.475 0L6.75 6.774a2.75 2.75 0 0 0-.596.892l-.848 2.047a.75.75 0 0 0 .98.98l2.047-.848a2.75 2.75 0 0 0 .892-.596l4.261-4.262a1.75 1.75 0 0 0 0-2.474Z" />
                <path d="M4.75 3.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h6.5c.69 0 1.25-.56 1.25-1.25V9A.75.75 0 0 1 14 9v2.25A2.75 2.75 0 0 1 11.25 14h-6.5A2.75 2.75 0 0 1 2 11.25v-6.5A2.75 2.75 0 0 1 4.75 2H7a.75.75 0 0 1 0 1.5H4.75Z" />
            </svg>
        </flux:button>
    </flux:tooltip>
    @php
        $currentUser = auth()->user();
        $rowIsRoot = $row->hasRole('root');
        $canDelete = false;
        if ($currentUser) {
            if ($currentUser->hasRole('root')) {
                $canDelete = !$row->is($currentUser); // root puede eliminar cualquier usuario excepto a sí mismo
            } elseif ($currentUser->hasRole('admin')) {
                $canDelete = !$rowIsRoot;
            }
        }
    @endphp
    @if($canDelete)
        <flux:tooltip :content="__('Delete')" position="left">
            <flux:button
                size="xs"
                variant="danger"
                class="cursor-pointer"
                x-data
                x-on:click="$dispatch('openDeleteUserModal', { userId: {{ $row->id }} }); $flux.modal('delete-user').show();"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 7.5V18a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 18V7.5M9.75 11.25v4.5m4.5-4.5v4.5M3.75 7.5h16.5m-14.25 0V6A2.25 2.25 0 0 1 8.25 3.75h7.5A2.25 2.25 0 0 1 18 6v1.5" />
                </svg>
            </flux:button>
        </flux:tooltip>
    @endif
</div>

