@props([
    'title' => null, 
    'description' => null,
    'actions' => null, 
    'footer' => null,
    'icon' => null,
    ])

<div {{ $attributes->merge(['class' => 'bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm overflow-hidden']) }}>
    @if($title)
        <div class="px-6 pt-4 flex items-top justify-between">
            <div class="flex items-center gap-3">
                @if($icon)
                    <flux:icon :icon="$icon" class="size-9" />
                @endif
                <div class="flex flex-col">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $title }}</h3>
                    @if($description)
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $description }}</p>
                    @endif
                </div>
            </div>
            
            @isset($actions)
                <div class="ml-auto">
                    {{ $actions }}
                </div>
            @endisset
        </div>
    @endif
    <div class="px-6 py-4">
        {{ $slot }}
    </div>
    @isset($footer)
        <div class="px-6 pb-6">
            {{ $footer }}
        </div>
    @endisset
</div>
