<div class="space-y-6 p-4">
    <div
        x-data="{ show: false, message: '', type: 'success', timeout: null }"
        x-on:notify.window="
            type = $event.detail.type;
            message = $event.detail.message;
            show = true;
            clearTimeout(timeout);
            timeout = setTimeout(() => show = false, 3000);
        "
    >
        <template x-if="show">
            <div class="fixed top-4 right-4 z-50 px-4 py-2 rounded shadow-lg text-white"
                :class="type === 'success' ? 'bg-green-600' : 'bg-yellow-600'">
                <span x-text="message"></span>
            </div>
        </template>
    </div>
    <x-ui.card title="{{ __('Manage API Tokens') }}">
        <div class="space-y-4">
            <div>
                <flux:input.group>
                    <flux:input placeholder="{{ __('Device Name') }}" wire:model.defer="device_name" />
                    <flux:button icon="plus" wire:click="generateToken">{{ __('Generate Token') }}</flux:button>
                </flux:input.group>
            </div>
            @if( isset($plainTextToken) )
                <div class="flex flex-col gap-2">
                    <flux:label>{{ __('New token generated:') }}</flux:label>
                    <flux:input icon="key" value="{{ $plainTextToken }}" readonly copyable />
                </div>
            @endif
        </div>
    </x-ui.card>

    <x-ui.card title="{{ __('Existing Tokens') }}">
        <table class="w-full table-auto border-collapse border border-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="border px-4 py-2 text-left">{{ __('Name') }}</th>
                    <th class="border px-4 py-2 text-left">{{ __('Created At') }}</th>
                    <th class="border px-4 py-2 text-left">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tokens as $token)
                    <tr wire:key="token-{{ $token->id }}">
                        <td class="border px-4 py-2">{{ $token->name }}</td>
                        <td class="border px-4 py-2">{{ $token->created_at->format('Y-m-d H:i') }}</td>
                        <td class="border px-4 py-2">
                            <button wire:click="revoke({{ $token->id }})" class="text-red-600 hover:text-red-800 text-sm">{{ __('Revoke') }}</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="border px-4 py-2 text-center">{{ __('No API tokens.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <button wire:click="revokeAll" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">{{ __('Revoke All') }}</button>
    </x-ui.card>
</div>
