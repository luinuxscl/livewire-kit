@props([
    'title' => 'Title Requirement',
    'description' => 'Description Requirement',
    'icon' => 'file-text',
    'step' => 1,
    'completed' => false,
])

<div class="flex items-start space-x-2">
    <div class="shrink-0 px-3">
        <flux:text class="font-bold text-3xl text-accent">{{ $step }}</flux:text>
    </div>
    <div class="flex-1 min-w-0 mx-3">
        <flux:heading size="lg" level="3" class="uppercase">{{ $title }}</flux:heading>
        <flux:text class="text-gray-500">{{ $description }}</flux:text>
    </div>
    <div class="shrink-0">
        @if ($completed)
            <flux:icon icon="circle-check-big" class="text-green-600" />
        @else
            <flux:icon icon="circle-dashed" class="text-gray-400" />
        @endif
        {{-- <flux:icon :icon="$completed ? 'check-circle' : 'circle-dashed'" variant="solid" class="text-green-600" /> --}}
    </div>
</div>


<div class="text-red-900">
    {{ $slot }}
</div>
