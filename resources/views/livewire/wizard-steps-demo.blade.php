<div>
    <flux:heading size="lg" class="mb-4">Demo Livewire + Steps</flux:heading>
    <x-steps :steps="$steps" :current="$current" />

    <div class="flex gap-2 mt-8">
        <button wire:click="prevStep"
            class="px-4 py-2 rounded bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors duration-200"
            @if($current === 1) disabled @endif>
            Anterior
        </button>
        <button wire:click="nextStep"
            class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700 transition-colors duration-200"
            @if($current === count($steps)) disabled @endif>
            Siguiente
        </button>
    </div>

    <div class="mt-8 p-4 rounded bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 transition-all duration-300">
        @if($current === 1)
            <div class="transition-opacity duration-300">Formulario de datos personales aquí...</div>
        @elseif($current === 2)
            <div class="transition-opacity duration-300">Formulario de dirección aquí...</div>
        @elseif($current === 3)
            <div class="transition-opacity duration-300">Formulario de pago aquí...</div>
        @elseif($current === 4)
            <div class="transition-opacity duration-300">Pantalla de confirmación aquí...</div>
        @endif
    </div>
</div>
