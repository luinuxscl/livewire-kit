@props([
    'user' => null,
    'showProfile' => true,
    ])

@php
    if (! ($user instanceof \App\Models\User)) {
        $user = auth()->user();
    }
    $profile = $user?->profile;
@endphp

<a href="{{ route('admin.users.show', $user) }}">

<x-ui.card :title="$user->name">

    <x-slot name="description">
        {{-- <flux:text>{{ $user->getRoleNames()->first() }}</flux:text> --}}
        <x-ui.role :role="$user->getRoleNames()->first()" />
    </x-slot>

    <x-slot name="actions">
        @empty(! $user->profile->avatar)
            <flux:avatar size="lg" src="{{ Storage::url($user->profile->avatar) }}" />
                @else
                <flux:avatar name="{{ $user->name }}" color="auto" size="lg" />
        @endempty
    </x-slot>

    <div class="flex flex-col gap-1">
        <div class="flex items-top gap-2">
            <flux:icon icon="mail" variant="micro" />
            <flux:text>{{ $user->email }}</flux:text>
        </div>
        @if($showProfile)
            @isset($profile->phone)
            <div class="flex items-top gap-2">
                <flux:icon icon="phone" variant="micro" />
                <flux:text>{{ $profile->phone }}</flux:text>
            </div>
            @endisset

            @isset($profile->address)
            <div class="flex items-top gap-2">
                <flux:icon icon="map-pin-house" variant="micro" />
                <flux:text>{{ $profile->address }}</flux:text>
            </div>
            @endisset
        @endif
    </div>

</x-ui.card>
</a>
