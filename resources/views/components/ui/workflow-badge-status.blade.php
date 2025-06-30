@props([
    'status' => 'error',
])
@php
    switch ($status) {
        case 'production':
            $color = 'green';
            break;
        case 'configured':
            $color = 'yellow';
            break;

        default:
            $color = 'zinc';
            break;
    }
@endphp
<flux:badge :color="$color">{{ __($status) }}</flux:badge>
