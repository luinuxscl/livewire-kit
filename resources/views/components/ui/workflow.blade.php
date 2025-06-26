@props([
    'title' => null,
    'description' => null,
    'actions' => null,
    'active' => true,
])

<div
    {{ $attributes->merge(['class' => 'bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm overflow-hidden']) }}>
    @if ($title)
        <div class="px-6 py-4 flex items-top justify-between">
            <div class="flex items-center space-x-4">

                <div class="flex flex-col">
                    <div class="flex items-center space-x-2">
                        <flux:heading size="lg" level="3">{{ $title }}</flux:heading>
                        <flux:icon :icon="$active ? 'check-circle' : 'circle-dashed'" variant="micro"
                            :color="$active ? 'green' : 'gray'" />

                    </div>
                    @if ($description)
                        <flux:text variant="subtle">{{ $description }}</flux:text>
                    @endif
                </div>
            </div>

            @isset($actions)
                <div class="ml-auto flex items-center space-x-2">
                    {{ $actions }}
                </div>
            @endisset
        </div>
    @endif
</div>
