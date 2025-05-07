<div>
    <x-ui.card>
        <div class="flex flex-col gap-1">
            <div class="flex items-center mb-3 mt-2">
                @empty(! $user->profile->avatar)
                    <flux:avatar class="w-full h-full" src="{{ Storage::url($user->profile->avatar) }}" />
                @else
                    <flux:avatar name="{{ $user->name }}" color="auto" class="w-full h-full" />
                @endempty
            </div>
            <div class="flex items-top gap-2">
                <flux:icon icon="user" variant="micro" />
                <flux:text>{{ $user->name }}</flux:text>
            </div>
            <div class="flex items-top gap-2">
                <flux:icon icon="mail" variant="micro" />
                <flux:text>{{ $user->email }}</flux:text>
            </div>
            @isset($user->profile->phone)
                <div class="flex items-top gap-2">
                    <flux:icon icon="phone" variant="micro" />
                    <flux:text>{{ $user->profile->phone }}</flux:text>
                </div>
            @endisset

            @isset($user->profile->address)
                <div class="flex items-top gap-2">
                    <flux:icon icon="map-pin-house" variant="micro" />
                    <flux:text>{{ $user->profile->address }}</flux:text>
                </div>
            @endisset
        </div>

        <x-slot name="footer">
            <div class="flex items-center justify-center gap-3">
                <flux:button icon="mail-plus" variant="primary" size="xs" disabled />
                <flux:button icon="message-circle" variant="primary" size="xs" disabled />
                <flux:separator vertical class="my-1" />
                <flux:badge variant="solid" color="yellow">{{ __('Under development') }}</flux:badge>
            </div>
        </x-slot>
    </x-ui.card>
</div>
