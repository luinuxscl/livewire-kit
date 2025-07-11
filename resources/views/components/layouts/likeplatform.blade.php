@props([
    'title' => '',
    'subtitle' => '',
    'icon' => 'panel-top',
])

<x-layouts.app :title="__($title)">
    <div class="mx-auto w-full h-full [:where(&)]:max-w-7xl px-6 lg:px-8">
        <div class="flex items-center justify-between mb-10">
            <div class="flex gap-2">
                <div class="flex pt-1 me-1">
                    <flux:icon. icon="{{ $icon }}" class="size-6" />                                   
                </div>
                <div class="flex flex-col">
                    <h2 class="text-2xl font-bold text-neutral-900 dark:text-white">{{ $title }}</h2>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400">
                        {{ $subtitle }}
                    </p>
                </div>
            </div>
            <div class="flex justify-end gap-2">

                @if (!request()->routeIs('dashboard'))
                <flux:tooltip content="Dashboard" position="left">
                    <flux:button
                    variant="primary"
                    :href="route('dashboard')"
                    icon="layout-grid"
                    >
                    </flux:button>
                </flux:tooltip>
                @endif


                @isset($buttons)
                    <flux:separator vertical class="my-2" />
                    {{ $buttons }}
                @endisset
            </div>
        </div>
        {{ $slot }}
    </div>
</x-layouts.app>