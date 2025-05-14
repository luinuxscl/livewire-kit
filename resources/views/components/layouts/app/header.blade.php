<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen flex flex-col bg-white dark:bg-zinc-800">
        <flux:header container class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <a href="{{ route('dashboard') }}" class="ms-2 me-5 flex items-center space-x-2 rtl:space-x-reverse lg:ms-0" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navbar class="-mb-px max-lg:hidden">
                <flux:navbar.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                    {{ __('Dashboard') }}
                </flux:navbar.item>

                @role('root')
                <flux:navbar.item icon="bolt" :href="route('playground')" :current="request()->routeIs('playground')" wire:navigate>
                    {{ __('Playground') }}
                </flux:navbar.item>
                @endrole
                
                <flux:navbar.item icon="information-circle" :href="route('about')" :current="request()->routeIs('about')" wire:navigate>
                    {{ __('About') }}
                </flux:navbar.item>
            </flux:navbar>

            <flux:spacer />

            <flux:navbar class="me-1.5 space-x-0.5 rtl:space-x-reverse py-0!">

                {{-- <flux:tooltip :content="__('Search')" position="bottom">
                    <flux:navbar.item class="!h-10 [&>div>svg]:size-5" icon="magnifying-glass" href="#" :label="__('Search')" />
                </flux:tooltip> --}}

                @role('root')
                <flux:tooltip :content="__('Repository')" position="bottom">
                    <flux:navbar.item
                        class="h-10 max-lg:hidden [&>div>svg]:size-5"
                        icon="folder-git-2"
                        href="https://github.com/luinuxscl/livewire-kit/tree/develop"
                        target="_blank"
                        :label="__('Repository')"
                    />
                </flux:tooltip>
                <flux:tooltip :content="__('Documentation')" position="bottom">
                    <flux:navbar.item
                        class="h-10 max-lg:hidden [&>div>svg]:size-5"
                        icon="book-open-text"
                        href="https://github.com/luinuxscl/livewire-kit/tree/develop/docs"
                        target="_blank"
                        label="Documentation"
                    />
                </flux:tooltip>

                
                <flux:tooltip :content="__('Users')" position="bottom">
                    <flux:navbar.item
                        class="h-10 max-lg:hidden [&>div>svg]:size-5"
                        icon="user-group"
                        href="{{ route('admin.users.index') }}"
                        label="Users"
                    />
                </flux:tooltip>
                @endrole

                <flux:dropdown x-data align="end">
                    <flux:button variant="subtle" square class="group cursor-pointer" aria-label="Preferred color scheme">
                        <flux:icon.sun x-show="$flux.appearance === 'light'" variant="mini" class="text-zinc-500 dark:text-white" />
                        <flux:icon.moon x-show="$flux.appearance === 'dark'" variant="mini" class="text-zinc-500 dark:text-white" />
                        <flux:icon.moon x-show="$flux.appearance === 'system' && $flux.dark" variant="mini" />
                        <flux:icon.sun x-show="$flux.appearance === 'system' && ! $flux.dark" variant="mini" />
                    </flux:button>

                    <flux:menu>
                        <flux:menu.item icon="sun" x-on:click="$flux.appearance = 'light'" class="cursor-pointer">{{ __('Light') }}</flux:menu.item>
                        <flux:menu.item icon="moon" x-on:click="$flux.appearance = 'dark'" class="cursor-pointer">{{ __('Dark') }}</flux:menu.item>
                        <flux:menu.item icon="computer-desktop" x-on:click="$flux.appearance = 'system'" class="cursor-pointer">{{ __('System') }}</flux:menu.item>
                    </flux:menu>
                </flux:dropdown>

                {{-- Selector de idioma --}}
                {{-- <div class="flex items-center px-1">
                    <livewire:language-switcher />
                </div> --}}

                
            </flux:navbar>

            <!-- Desktop User Menu -->
            <flux:dropdown position="top" align="end">

                @if (auth()->user()->profile->avatar)
                <flux:profile
                    class="cursor-pointer"
                    :initials="auth()->user()->initials()"
                    :avatar="Storage::url(auth()->user()->profile->avatar)"
                    :name="auth()->user()->name"
                />
                @else
                <flux:profile
                    class="cursor-pointer"
                    :initials="auth()->user()->initials()"
                    :name="auth()->user()->name"
                />
                @endif

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">

                                {{-- Si en avatar existe y no esta vacio o null en profile, mostrar imagen usando componente de flexUI, sino mostrar iniciales --}}
                                @if (auth()->user()->profile->avatar)
                                <flux:avatar :src="Storage::url(auth()->user()->profile->avatar)" />
                                @else
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>
                                @endif

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        <!-- Mobile Menu -->
        <flux:sidebar stashable sticky class="lg:hidden border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="ms-1 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Platform')">
                    <flux:navlist.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                    {{ __('Dashboard') }}
                    </flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />

            <flux:navlist variant="outline">
                <flux:navlist.item icon="folder-git-2" href="https://github.com/luinuxscl/livewire-kit/tree/develop" target="_blank">
                {{ __('Repository') }}
                </flux:navlist.item>

                <flux:navlist.item icon="book-open-text" href="https://github.com/luinuxscl/livewire-kit/tree/develop/docs" target="_blank">
                {{ __('Documentation') }}
                </flux:navlist.item>

                <flux:navlist.item icon="book-open-text" href="{{ route('admin.users.index') }}" target="_blank">
                {{ __('Users') }}
                </flux:navlist.item>
            </flux:navlist>
        </flux:sidebar>

        <main class="flex-1 flex flex-col">
            {{ $slot }}
            @livewire('toast-manager')
        </main>

        @include('components.layouts.app.footer')

        @fluxScripts
        @stack('scripts')
        @stack('modals')
        @include('components.layouts.app.scripts')
    </body>
</html>
