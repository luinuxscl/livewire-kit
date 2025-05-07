@props([
    'role' => null
])

<flux:text variant="strong" :color="$role === 'root' ? 'red' : 'yellow'">
    {{ $role }}
</flux:text>