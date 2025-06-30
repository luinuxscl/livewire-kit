<div>
    <flux:tooltip :content="$isActive ? __('Turn off') : __('Turn on')" position="bottom">
        <flux:button :icon="$isActive ? 'power' : 'power-off'"
            class="cursor-pointer btn {{ $isActive ? 'btn-success' : 'btn-muted' }}" wire:click="toggle" />
    </flux:tooltip>
</div>
