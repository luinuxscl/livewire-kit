@props([
    'role' => null,
])

@php
    $colors = [
        'root' => 'red',
        'admin' => 'amber',
        'standard' => 'zinc',
    ];
@endphp

@if(isset($role))
    <flux:badge color="{{ $colors[$role] }}" size="sm">{{ $role }}</flux:badge>
@endif