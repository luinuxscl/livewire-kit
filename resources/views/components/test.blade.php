<div>
    <ul class="timeline">
        <li>
            <div class="timeline-start timeline-box">First Macintosh computer</div>
            <div class="timeline-middle">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    class="text-primary h-5 w-5">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <hr class="bg-primary" />
        </li>
        <li>
            <hr class="bg-primary" />
            <div class="timeline-middle">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    class="text-primary h-5 w-5">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="timeline-end timeline-box">iMac</div>
            <hr class="bg-primary" />
        </li>
        <li>
            <hr class="bg-primary" />
            <div class="timeline-start timeline-box">iPod</div>
            <div class="timeline-middle">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    class="text-primary h-5 w-5">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <hr />
        </li>
        <li>
            <hr />
            <div class="timeline-middle">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="timeline-end timeline-box">iPhone</div>
            <hr />
        </li>
        <li>
            <hr />
            <div class="timeline-start timeline-box">Apple Watch</div>
            <div class="timeline-middle">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                        clip-rule="evenodd" />
                </svg>
            </div>
        </li>
    </ul>
</div>
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
