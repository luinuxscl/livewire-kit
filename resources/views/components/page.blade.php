@props(['title' => ''])
<x-layouts.app :title="$title">
    <x-main>
        {{ $slot }}
    </x-main>
</x-layouts.app>
