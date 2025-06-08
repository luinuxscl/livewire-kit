@props([
    'steps' => [], // Puede ser array de strings o de arrays ['label'=>..., 'desc'=>...]
    'current' => 1, // Índice base 1 del paso activo
    'size' => 'normal', // 'normal' o 'small'
])

@php
    $count = count($steps);
@endphp

<div class="flex flex-col {{ $size === 'small' ? 'step-small' : '' }}">
    @foreach($steps as $i => $step)
        @php
            // Soporte retrocompatible: string = label, sin descripción
            $label = is_array($step) ? ($step['label'] ?? '') : $step;
            $desc = is_array($step) ? ($step['desc'] ?? null) : null;
            $stepNum = $i + 1;
            $isCompleted = $stepNum < $current;
            $isActive = $stepNum === (int)$current;
            $isInactive = $stepNum > $current;
        @endphp
        <div class="flex items-stretch">
            <div class="flex flex-col items-center mr-4 mt-0">
                <div class="step-circle
                    @if($isCompleted) bg-green-600 text-white @elseif($isActive) bg-blue-600 text-white @else bg-gray-300 text-gray-500 dark:bg-gray-700 dark:text-gray-400 @endif
                    flex items-center justify-center font-semibold
                    {{ $size === 'small' ? '' : 'w-8 h-8 text-sm' }}
                    z-10
                ">
                    @if($isCompleted)
                        ✓
                    @else
                        {{ $stepNum }}
                    @endif
                </div>
                @if($stepNum < $count)
                    <div class="step-line
                        @if($isCompleted) bg-green-600 @elseif($isActive) bg-blue-600 @else bg-gray-300 dark:bg-gray-700 @endif
                        w-0.5 flex-1 mt-0
                        {{ $size === 'small' ? '' : '' }}
                    "></div>
                @endif
            </div>
            <div class="step-content flex flex-col justify-center {{ $size === 'small' ? '' : 'pb-6' }}">
                <span class="step-text font-medium
                    @if($isCompleted || $isActive) text-gray-900 dark:text-gray-100 @else text-gray-500 dark:text-gray-300 @endif
                    {{ $size === 'small' ? '' : '' }}
                ">
                    {{ $label }}
                </span>
                @if($desc)
                    <div class="text-xs mt-1 text-gray-500 dark:text-gray-400 leading-tight">{{ $desc }}</div>
                @endif
            </div>
        </div>
    @endforeach
</div>
