@props([
    'type' => 'success',
    'icon' => null,
    'role' => 'alert',
    'title' => null,
    'text' => null,
    'actions' => null,
])
@php
    $classes = match ($type) {
        'info'
            => 'text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800',
        'danger'
            => 'text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800',
        'success'
            => 'text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800',
        'warning'
            => 'text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 dark:border-yellow-800',
        'dark'
            => 'text-gray-800 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-800',
        default
            => 'text-gray-800 border border-gray-300 rounded-lg bg-white dark:bg-gray-800 dark:text-gray-300 dark:border-gray-800',
    };
    $classes .= ' flex justify-between items-center p-4 mb-4 text-sm';
    $classes .= ' ' . ($attributes->get('class') ?? '');
    $role = $attributes->get('role') ?? 'alert';
    $attributes = $attributes->except(['class', 'role']);
    $attributes = $attributes->merge(['class' => $classes, 'role' => $role]);

    if (!$icon) {
        $icon = match ($type) {
            'info' => 'info',
            'danger' => 'exclamation-triangle',
            'success' => 'check-circle',
            'warning' => 'exclamation-circle',
            'dark' => 'question-circle',
            default => 'bell',
        };
    }

@endphp

<div {{ $attributes }}>
    <div class="flex items-center">
        <flux:icon name="{{ $icon }}" class="flex-shrink-0 w-5 h-5 mr-3" aria-hidden="true"></flux:icon>
        <span class="sr-only">Info</span>
        <div>
            @if ($title)
                <span class="font-medium">{{ $title }}</span>
            @endif
            {{ $text ?? $slot }}
        </div>
    </div>
    @if ($actions)
        <div class="flex-shrink-0 ml-3 flex items-center">
            {{ $actions }}
        </div>
    @endif

</div>
