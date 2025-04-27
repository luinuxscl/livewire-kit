<x-layouts.app :title="__('About')">
    <div class="container mx-auto flex-1 flex-col px-6 lg:px-8 py-10">
        <div class="mb-8">
            <h1 class="text-3xl font-bold mb-2">{{ __('LikePlatform StarterKit') }}</h1>
            <p class="text-lg text-gray-600 dark:text-gray-300 mb-4">
                {{ __('Este proyecto es un starterkit para Laravel 12 con Livewire, diseñado para servir como base sólida, moderna y limpia para nuevas aplicaciones.') }}
            </p>
            <flux:separator />
        </div>
        <div class="flex flex-col md:flex-row gap-6">
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-2">{{ __('¿Qué incluye?') }}</h2>
                <ul class="list-disc list-inside text-gray-700 dark:text-gray-200 space-y-1">
                    <li>{{ __('Estructura de carpetas y layouts reutilizables, siguiendo buenas prácticas.') }}</li>
                    <li>{{ __('Componentes modernos con Livewire y Flux para UI reactiva.') }}</li>
                    <li>{{ __('Gestión de roles y permisos (Spatie).') }}</li>
                    <li>{{ __('Tablas avanzadas y dinámicas (Livewire Tables).') }}</li>
                    <li>{{ __('Sistema de autenticación y panel de usuario listo para usar.') }}</li>
                    <li>{{ __('Ejemplo de internacionalización y soporte multi-idioma.') }}</li>
                    <li>{{ __('Documentación y patrón para agregar nuevas páginas fácilmente.') }}</li>
                </ul>
            </div>
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-2">{{ __('Ventajas') }}</h2>
                <ul class="list-disc list-inside text-gray-700 dark:text-gray-200 space-y-1">
                    <li>{{ __('Código limpio y desacoplado, fácil de mantener y escalar.') }}</li>
                    <li>{{ __('Personalización sencilla para proyectos derivados.') }}</li>
                    <li>{{ __('Consistencia visual y de estructura en toda la app.') }}</li>
                </ul>
            </div>
        </div>
        
        <div class="text-sm text-gray-500 dark:text-gray-400">
            {{ __('Consulta la documentación incluida para aprender a extender y personalizar este kit.') }}
        </div>
    </div>
</x-layouts.app>