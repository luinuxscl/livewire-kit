<div>
    <x-ui.card>

        <div x-data="{tab: $wire.tab}">

            <div class="flex items-center justify-between py-2 mb-2">
                <flux:heading size="lg">
                    {{ __('User Management') }}
                </flux:heading>
                <div class="gap-2 flex items-center">
                    <flux:button icon="user-pen" variant="{{ $tab == 1 ? 'primary' : 'ghost' }}" x-on:click="$wire.editTab(1).live()" class="btn">
                        {{ __('Edit') }}
                    </flux:button>
                    <flux:button icon="tag" variant="{{ $tab == 2 ? 'primary' : 'ghost' }}" x-on:click="$wire.editTab(2).live()" class="btn">
                        Tab 2
                    </flux:button>
                    <flux:button icon="tag" variant="{{ $tab == 3 ? 'primary' : 'ghost' }}" x-on:click="$wire.editTab(3).live()" class="btn">
                        Tab 3
                    </flux:button>
                </div>
            </div>

            <div>
                <div x-show="$wire.tab == 1" x-transition>
                    <livewire:admin.user-edit :userId="$user->id" />
                </div>

                <div x-show="$wire.tab == 2" x-transition>
                    <flux:heading size="lg">Tab 2</flux:heading>
                </div>

                <div x-show="$wire.tab == 3" x-transition>
                    <flux:heading size="lg">Tab 3</flux:heading>
                </div>
            </div>

        </div>

        

        
        

    </x-ui.card>
</div>
