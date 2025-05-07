<div class="flex justify-end gap-2">
    <flux:tooltip :content="__('Show')" position="left">
        <flux:button
            size="xs"
            class="cursor-pointer"
            :href="route('admin.users.show', $row->id)"
        >
            <flux:icon icon="eye" variant="micro" />
        </flux:button>
    </flux:tooltip>
    <flux:tooltip :content="__('Edit')" position="left">
        <flux:button
            size="xs"
            class="cursor-pointer"
            x-data
            x-on:click="$dispatch('openEditUserModal', { userId: {{ $row->id }} }); $flux.modal('edit-user').show();"
        >
            <flux:icon icon="square-pen" variant="micro" />
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

