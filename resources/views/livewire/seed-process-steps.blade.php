<div
    x-data="{
        listen() {
            window.Livewire.on('seed-process:advance', () => $wire.nextStep());
            window.Livewire.on('seed-process:working', v => $wire.setWorking(v));
            window.Livewire.on('seed-process:set', step => $wire.setStep(step));
        }
    }"
    x-init="listen()"
>
    <flux:heading size="lg" class="mb-4">Flujo Seed Process</flux:heading>
    <div class="max-w-md">
        <div class="flex flex-col">
            @foreach($steps as $i => $step)
                @php
                    $stepNum = $i + 1;
                    $isCompleted = $stepNum < $currentStep;
                    $isActive = $stepNum === (int)$currentStep;
                    $isWorking = $isActive && $working;
                @endphp
                <div class="flex items-stretch">
                    <div class="flex flex-col items-center mr-4 mt-0">
                        <div class="step-circle
                            @if($isCompleted) bg-green-600 text-white @elseif($isActive) bg-blue-600 text-white @else bg-gray-300 text-gray-500 dark:bg-gray-700 dark:text-gray-400 @endif
                            flex items-center justify-center font-semibold w-8 h-8 text-sm z-10
                            transition-all duration-300
                            @if($isActive) scale-105 shadow-lg @endif
                            @if($isWorking) animate-pulse ring-2 ring-blue-400 ring-offset-2 @endif
                        ">
                            @if($isWorking)
                                <svg class="animate-spin h-4 w-4 mr-0.5" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path></svg>
                            @elseif($isCompleted)
                                ✓
                            @else
                                {{ $stepNum }}
                            @endif
                        </div>
                        @if($stepNum < count($steps))
                            <div class="step-line
                                @if($isCompleted) bg-green-600 @elseif($isActive) bg-blue-600 @else bg-gray-300 dark:bg-gray-700 @endif
                                w-0.5 flex-1 mt-0
                            "></div>
                        @endif
                    </div>
                    <div class="step-content flex flex-col justify-center pb-6">
                        <span class="step-text font-medium
                            @if($isCompleted || $isActive) text-gray-900 dark:text-gray-100 @else text-gray-500 dark:text-gray-300 @endif
                        ">
                            {{ $step['label'] }}
                        </span>
                        @if(!empty($step['desc']))
                            <div class="text-xs mt-1 text-gray-500 dark:text-gray-400 leading-tight">{{ $step['desc'] }}</div>
                        @endif
                        @if($isActive)
                            <div class="flex gap-2 mt-2">
                                <button wire:click="nextStep" class="px-3 py-1 rounded bg-blue-600 text-white text-xs hover:bg-blue-700 transition-colors duration-200" @if($currentStep === count($steps)) disabled @endif>Avanzar</button>
                                <button wire:click="startWorking" class="px-3 py-1 rounded bg-yellow-500 text-white text-xs hover:bg-yellow-600 transition-colors duration-200" @if($working) disabled @endif>Marcar trabajando</button>
                                <button wire:click="stopWorking" class="px-3 py-1 rounded bg-gray-400 text-white text-xs hover:bg-gray-500 transition-colors duration-200" @if(!$working) disabled @endif>Detener trabajo</button>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
