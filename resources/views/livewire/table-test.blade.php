<div>
    <div class="mb-4">
        <input type="text" wire:model.live="search" placeholder="Buscar por nombre..."
            class="border rounded px-2 py-1" />
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="table-like">
            <thead>
                <tr>
                    <th scope="col" class="table-like-th">ID</th>
                    <th scope="col" class="table-like-th">Name</th>
                    <th scope="col" class="table-like-th">Email</th>
                    <th scope="col" class="table-like-th">Email verified at</th>
                    <th scope="col" class="table-like-th">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="table-like-tbody-tr">
                        <th scope="row" class="table-like-th-row">{{ $user->id }}</th>
                        <td class="table-like-td">{{ $user->name }}</td>
                        <td class="table-like-td">{{ $user->email }}</td>
                        <td class="table-like-td">{{ $user->email_verified_at->diffForHumans() }}</td>
                        <td class="table-like-td text-right">
                            <flux:tooltip :content="__('Edit')" position="left">
                                <flux:button icon="square-pen" variant="ghost" class="cursor-pointer" size="xs" />
                            </flux:tooltip>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
