# 05 - Módulos y Paquetes en LikePlatform

## Estructura de Módulos como Paquetes Laravel

La arquitectura de LikePlatform se basa en la modularidad extrema, donde cada funcionalidad autocontenida, ya sea un módulo estándar o uno desarrollado a medida (custom), se implementa como un **Paquete Laravel** independiente.

-   **Vendor Predeterminado:** `luinuxscl` (Ver `contexto_creacion_packages.md` para detalles del autor y configuración `composer.json` base).
-   **Naming Convention:** `luinuxscl/nombre-del-modulo` (ej. `luinuxscl/crm-module`, `luinuxscl/ai-assistant`, `luinuxscl/client-xyz-custom-inventory`).
-   **Autocontenidos:** Cada paquete debe incluir todos sus componentes necesarios:
    -   `ServiceProvider` (punto de entrada principal del paquete).
    -   Rutas (web, API, consola).
    -   Controladores.
    -   Modelos Eloquent (si maneja sus propias entidades o extiende las del core).
    -   Migraciones de Base de Datos.
    -   Factorías y Seeders (opcional).
    -   Vistas Blade (namespaced, ej. `crm::nombre.vista`).
    -   Componentes Livewire (si aplica).
    -   Assets (CSS, JS, imágenes) que pueden ser publicados.
    -   Archivos de Configuración (publicables).
    -   Archivos de Traducción (publicables).
    -   Pruebas (unitarias, de integración, funcionales).
-   **Independencia:** Un paquete no debe depender directamente de la lógica interna de otro paquete de módulo, sino interactuar a través de eventos, servicios del core de LikePlatform, o APIs bien definidas si es estrictamente necesario. Las dependencias deben ser principalmente con el framework Laravel o librerías de terceros.

## "Modo Bloqueado" (Feature Flagging dentro de Paquetes)

La activación y desactivación de la funcionalidad de un paquete (su "Modo Bloqueado") se gestiona mediante Laravel Pennant, orquestado por el "Módulo de Sistema" de la instancia de cliente.

1.  **Verificación en el ServiceProvider:**

    -   El método `boot()` (o `register()` si es más apropiado) del `ServiceProvider` de cada paquete es el principal punto de control.
    -   Debe verificar el flag de Pennant correspondiente a la activación general del módulo antes de registrar cualquier componente.

    ```php
    // En el ServiceProvider de, por ejemplo, luinuxscl/crm-module
    use Illuminate\Support\Facades\Pennant;

    public function boot()
    {
        if (!Pennant::active('module_luinuxscl/crm-module')) {
            // MODO BLOQUEADO: El módulo no está activo para esta instancia.
            // No se registran rutas, vistas, componentes, listeners, etc.
            // Opcionalmente, se puede registrar una ruta que muestre "Módulo CRM no activo".
            return;
        }

        // MÓDULO ACTIVO: Proceder con la carga normal.
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'crm'); // Namespace 'crm'
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations'); // Si no se manejan desde el System Module

        // Cargar assets publicables
        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/luinuxscl/crm-module'),
        ], ['likeplatform-crm-assets', 'likeplatform-assets']); // Tags para publicación

        // Registrar lógica para "mejoras" internas del módulo
        if (Pennant::active('feature_crm-module_advanced_reporting')) {
            // Lógica específica para reportes avanzados del CRM
        }
    }
    ```

2.  **Verificación de Features Internas ("Mejoras"):**
    -   Dentro del código del paquete (Controladores, Modelos, Componentes Livewire, Vistas Blade), se pueden verificar flags de Pennant más granulares para habilitar o deshabilitar sub-funcionalidades específicas que dependen del plan o de configuraciones especiales.
    ```php
    // En un componente Livewire del CRM
    public function render()
    {
        $canExport = Pennant::active('feature_crm-module_allow_export');
        return view('crm::livewire.contact-list', ['canExport' => $canExport]);
    }
    ```
    ```blade
    {{-- En una vista Blade del CRM --}}
    @if (Pennant::active('feature_crm-module_allow_export'))
        <button wire:click="exportContacts">Exportar</button>
    @else
        <p class="text-muted_small">La funcionalidad de exportación no está disponible en su plan actual.</p>
    @endif
    ```

## Gestión de Dependencias y Publicación

-   **`composer.json` del Paquete:** Cada paquete definirá sus propias dependencias PHP y de librerías de terceros. Deberá seguir la estructura definida en `contexto_creacion_packages.md`.
-   **Publicación de Recursos:**
    -   Los paquetes deben permitir la publicación de sus assets (CSS, JS, imágenes), archivos de configuración, y archivos de traducción utilizando los mecanismos estándar de Laravel (`php artisan vendor:publish`).
    -   Se deben usar tags específicos para la publicación (ej. `crm-module-config`, `crm-module-views`, `crm-module-assets`).
    -   El "Módulo de Sistema" o el administrador de la instancia cliente podrían gestionar la ejecución de estos comandos de publicación cuando un módulo se activa por primera vez.
-   **Migraciones:**
    -   Las migraciones de los paquetes pueden ser cargadas automáticamente por el `ServiceProvider` usando `$this->loadMigrationsFrom()`.
    -   Alternativamente, para un control más fino, las migraciones podrían ser publicadas y ejecutadas manualmente o por el "Módulo de Sistema" durante la "autorización" del módulo.

## Interacción entre Módulos

-   Se debe priorizar el bajo acoplamiento entre módulos.
-   Si un módulo necesita interactuar con otro, debe hacerse preferentemente a través de:
    -   **Eventos y Listeners de Laravel:** Un módulo dispara un evento, otro módulo lo escucha.
    -   **Servicios del Core de LikePlatform:** Si existe una funcionalidad central que ambos módulos necesiten.
    -   **API Internas (si es inevitable):** Si un módulo expone una API interna, debe estar bien documentada y versionada.

## Referencias

-   Consultar `contexto_creacion_packages.md` para la estructura base del `composer.json` y datos del autor/vendor (`luinuxscl`).
-   Consultar `convenciones_nomenclatura_laravel.md` para el nombramiento dentro de los paquetes.
