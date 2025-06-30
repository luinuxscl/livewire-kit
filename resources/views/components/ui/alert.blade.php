@props([
    'type' => 'success',
    'icon' => null,
    'role' => 'alert',
    'title' => null,
    'text' => null,
    'actions' => null,
])
@php
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

<div role="alert" class="alert alert-{{ $type }}">
    <flux:icon name="{{ $icon }}" class="flex-shrink-0 w-5 h-5 mr-3" aria-hidden="true"></flux:icon>
    <span>
        @if ($title)
            <span class="font-medium">{{ $title }}</span>
        @endif
        {{ $text ?? $slot }}
    </span>
</div>
