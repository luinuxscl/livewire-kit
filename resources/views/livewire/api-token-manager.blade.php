<div>
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

    @if( isset($plainTextToken) )
            <div class="flex flex-col gap-2 mb-6">
                <flux:label>{{ __('New token generated:') }}</flux:label>
                <flux:input icon="key" value="{{ $plainTextToken }}" readonly copyable />
            </div>
        @else
        <div class="flex flex-col gap-4 mb-6" >
            <div>
                <flux:field>
                    <flux:label>{{ __('Token Name') }}</flux:label>
                    <flux:input wire:model.defer="device_name" :placeholder="__('Unique name for this token')" />
                </flux:field>
            </div>
    
            <div>
                <flux:label for="expiration">{{ __('Expiration') }}</flux:label>
                <flux:select wire:model="expiration" 
                placeholder="Choose expiration..."
                class="mt-2">
                    <flux:select.option value="7">7 days</flux:select.option>
                    <flux:select.option value="30" selected>30 days</flux:select.option>
                    <flux:select.option value="60">60 days</flux:select.option>
                    <flux:select.option value="90">90 days</flux:select.option>
                    <flux:select.option value="365">365 days</flux:select.option>
                </flux:select>
            </div>
            <div>
                <flux:button wire:click="generateToken" class="btn btn-success">
                    {{ __('Generate Token') }}
                </flux:button>
            </div>
        </div>
       
        @endif

    <div>
        <table class="w-full table-auto border-collapse border border-gray-200 mb-4">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th class="border px-4 py-2 text-left">{{ __('Name') }}</th>
                    <th class="border px-4 py-2 text-left">{{ __('Created At') }}</th>
                    <th class="border px-4 py-2 text-left">{{ __('Expiration') }}</th>
                    <th class="border px-4 py-2 text-left">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tokens as $token)
                    <tr wire:key="token-{{ $token->id }}">
                        <td class="border px-4 py-2">{{ $token->name }}</td>
                        <td class="border px-4 py-2">{{ $token->created_at->format('d-m-Y H:i') }}</td>
                        <td class="border px-4 py-2">
    @if($token->expires_at)
        @php
            $expires = \Carbon\Carbon::parse($token->expires_at);
            $diff = now()->startOfDay()->diffInDays($expires->startOfDay(), false);
        @endphp
        @if($diff > 0)
            {{ $diff }} {{ __('days') }}
        @elseif($diff === 0)
            {{ __('Expires today') }}
        @else
            <span class="text-red-600">{{ __('Expired') }}</span>
        @endif
    @else
        -
    @endif
</td>
                        <td class="border px-4 py-2 text-center">
                            <flux:button icon="trash" variant="danger" size="xs" wire:click="revoke({{ $token->id }})" />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="border px-4 py-2 text-center">{{ __('No API tokens.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <flux:button icon="trash" wire:click="revokeAll" variant="danger" class="btn">
            {{ __('Revoke All') }}
        </flux:button>
    </div>
</div>
