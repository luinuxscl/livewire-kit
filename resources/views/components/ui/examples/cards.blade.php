<x-ui.card title="Mixto" class="mx-auto w-1/2 mt-4">
    <img src="{{ asset('images/developer.jpg') }}" alt="Imagen de ejemplo" class="mb-4 w-full h-auto rounded">
    <p class="text-gray-700 dark:text-gray-300">Contenido mixto: texto, imagen y botones.</p>
</x-ui.card>

<x-ui.card title="{{ __('Example') }}" class="mx-auto w-1/2 mt-8">
    <p class="">{{ __('Contenido con acciones en el header y footer.') }}</p>
    <x-slot name="footer">
        <div class="flex justify-end gap-2">
            <flux:button icon="x" variant="filled" class="cursor-pointer" size="sm">{{ __('Cancel') }}</flux:button>
            <flux:button icon="trash" variant="danger" class="cursor-pointer" size="sm">{{ __('Delete') }}</flux:button>
            <flux:button icon="save" variant="primary" class="cursor-pointer" size="sm">{{ __('Save') }}</flux:button>
        </div>
    </x-slot>
</x-ui.card>

<x-ui.card title="Este es el titulo" class="mx-auto w-1/2 mt-8">
    <x-slot name="actions">
        <flux:button icon="save" size="xs" variant="primary" class="cursor-pointer"></flux:button>
    </x-slot>
    <p class="">nada mas que una linea de texto</p>
</x-ui.card>

<x-ui.card class="mx-auto w-1/2 mt-8">
    <p class="">nada mas que una linea de texto</p>
</x-ui.card>