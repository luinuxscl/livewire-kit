@role('admin|root')
<div>
    <flux:button
        variant="primary"
        x-data
        x-on:click="$wire.dispatch('openCreateUserModal'); $flux.modal('create-user').show();"
    >
        {{ __('New User') }}
    </flux:button>
</div>
@endrole
