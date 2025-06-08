<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">


<div>
    @livewire('seed-process-steps')
</div>


    <div>
        <flux:heading size="lg" class="mb-4">Steps Component</flux:heading>
        <x-steps :steps="['Register', 'Choose plan', 'Purchase', 'Receive Product']" :current="1" />
    </div>

    <div>
        <flux:heading size="lg" class="mb-4">Paso 1 activo</flux:heading>
        <x-steps :steps="['Register', 'Choose plan', 'Purchase', 'Receive Product']" :current="1" size="small" />
    </div>

    <div>
        <flux:heading size="lg" class="mb-4">Todos completados</flux:heading>
        <x-steps :steps="['Register', 'Choose plan', 'Purchase', 'Receive Product']" :current="5" size="small" />
    </div>

    <div>
        <flux:heading size="lg" class="mb-4">Ejemplo avanzado (pasos dinámicos y descripción)</flux:heading>
        @php
            $advancedSteps = [
                ['label' => 'Datos personales', 'desc' => 'Completa tu información básica'],
                ['label' => 'Dirección', 'desc' => 'Agrega tu dirección de envío'],
                ['label' => 'Pago', 'desc' => 'Selecciona método de pago'],
                ['label' => 'Confirmación', 'desc' => 'Revisa y confirma tu pedido'],
            ];
        @endphp
        <x-steps :steps="$advancedSteps" :current="3" />
    </div>

    <div>
        @livewire('wizard-steps-demo')
    </div>
</div>
