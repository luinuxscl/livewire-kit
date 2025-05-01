<div>
    <flux:modal name="delete-user" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Delete User') }}</flux:heading>
                <flux:subheading>
                    {{ __('Are you sure you want to delete this user') }}
                    <span class="font-bold">{{ $userEmail }}</span>?
                    <br>
                    {{ __('This action is irreversible.') }}
                </flux:subheading>
            </div>
            <form wire:submit.prevent="deleteUser" class="space-y-4">
                <flux:input
                    :label="__('Write the user email to confirm')"
                    placeholder="{{ $userEmail }}"
                    wire:model="confirmEmail"
                    required
                />
                <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                    <flux:modal.close>
                        <flux:button variant="filled">{{ __('Cancel') }}</flux:button>
                    </flux:modal.close>
                    <flux:button type="submit" variant="danger">
                        {{ __('Delete') }}
                    </flux:button>
                    @if($confirmEmail && $confirmEmail !== $userEmail)
                        <div class="text-xs text-red-500 mt-2">
                            {{ __('The email does not match. Write the exact email to confirm.') }}
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </flux:modal>
</div>
