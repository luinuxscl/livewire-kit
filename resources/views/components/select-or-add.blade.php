@props([
    'label' => 'Label',
    'button' => null
])

<div class="flex flex-col gap-2">
    <flux:label :for="$label">{{ $label }}</flux:label>
    <div class="flex gap-2 justify-between">
        <div>
            {{ $slot }}
        </div>
        <div class="flex gap-2">
            {{ $button }}
        </div>
    </div>
</div>