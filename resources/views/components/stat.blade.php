<div class="stat">

    @if ($icon)
        <div class="stat-figure text-{{ $color }} ms-4">
            <flux:icon :icon="$icon" class="size-9" />
        </div>
    @endif

    <div class="stat-title text-gray-700 dark:text-gray-400">{{ $title }}</div>
    <div class="stat-value text-gray-900 dark:text-white {{ isset($valueClass) ? $valueClass : '' }}">{{ $value }}
    </div>
    <div class="stat-desc text-gray-600 dark:text-gray-500">
        @if ($description)
            {{ $description }}
        @endif
    </div>
    <div>
        @if ($slot->isNotEmpty())
            <div>
                {{ $slot }}
            </div>
        @endif
    </div>

</div>
