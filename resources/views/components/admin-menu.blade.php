@role('admin|root')
    <flux:dropdown>
        <flux:button icon:trailing="chevron-down" variant="ghost" class="cursor-pointer">{{ __('Admin') }}</flux:button>

        <flux:menu>
            <flux:menu.item icon="users" class="btn" :href="route('admin.users.index')">
                {{ __('Users') }}
            </flux:menu.item>

            <flux:menu.item icon="shield-user" class="btn" :href="route('admin.roles.index')">
                {{ __('Roles') }}
            </flux:menu.item>

            <flux:menu.separator />
            <flux:menu.item icon="folder-code" :href="route('customization')">{{ __('Customization') }}</flux:menu.item>
            <flux:menu.item icon="bolt" :href="route('playground')">{{ __('Playground') }}</flux:menu.item>

            {{-- <flux:menu.submenu heading="Sort by">
                <flux:menu.radio.group>
                    <flux:menu.radio checked>Name</flux:menu.radio>
                    <flux:menu.radio>Date</flux:menu.radio>
                    <flux:menu.radio>Popularity</flux:menu.radio>
                </flux:menu.radio.group>
            </flux:menu.submenu>

            <flux:menu.submenu heading="Filter">
                <flux:menu.checkbox checked>Draft</flux:menu.checkbox>
                <flux:menu.checkbox checked>Published</flux:menu.checkbox>
                <flux:menu.checkbox>Archived</flux:menu.checkbox>
            </flux:menu.submenu>

            <flux:menu.separator />

            <flux:menu.item variant="danger" icon="trash">Delete</flux:menu.item> --}}
        </flux:menu>
    </flux:dropdown>
@endrole
