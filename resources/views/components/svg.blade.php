@props([
    'name' => 'null',
    'size' => '24',
])

@include("svgs.{$name}", [
    'size' => $size,
])

{{-- Example usage: --}}
{{-- <x-svg name="icon-name" size="32" /> --}}
