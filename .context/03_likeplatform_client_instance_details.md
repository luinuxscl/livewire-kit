# 03 - Detalles de la Instancia de Cliente de LikePlatform

## Panel Base (LikePlatform Core)

Cada instancia de cliente se basa en el "Panel Base" de LikePlatform, cuyo desarrollo ya está avanzado y provee:

-   **Gestión de Usuarios:** Creación, edición, eliminación de usuarios propios de la instancia del cliente.
-   **Autenticación:** Sistema seguro de inicio de sesión, incluyendo recordatorio/reseteo de contraseña. (Se asume una base como Laravel Breeze, Jetstream, o una implementación custom robusta).
-   **Roles y Permisos:** Sistema para definir roles (ej. Administrador, Editor, Usuario) y asignar permisos granulares a las diferentes secciones y acciones dentro del panel de esa instancia. (Se recomienda el uso de `spatie/laravel-permission` o similar).
-   **Personalización de Datos:** Capacidad para que el cliente configure ciertos aspectos de su instancia (ej. nombre de la empresa para reportes, formatos de fecha/hora preferidos, etc.).
-   **Personalización de Branding:** Posibilidad de que el cliente (o "Like" durante la configuración inicial) ajuste el logo, colores primarios/secundarios, y otros elementos visuales para alinear el panel con la identidad de marca del cliente. Esta personalización puede estar sujeta al plan de suscripción (ej. white-labeling completo en planes superiores).

## "Módulo de Sistema" (Conector LSMS)

Cada instancia de cliente de LikePlatform incluirá un paquete Laravel esencial, provisionalmente llamado `luinuxscl/system-connector` (el nombre final puede variar). Este módulo es invisible para el usuario final del cliente, pero crucial para la operativa.

**Responsabilidades:**

1.  **Comunicación con LSMS:**
    -   Contiene la lógica para realizar llamadas HTTP seguras (cliente Guzzle o `Http::` de Laravel) al endpoint de entitlements del LSMS.
    -   Gestiona la autenticación con el LSMS usando el `INSTANCE_ID` (identificador único de la instancia) y el `LSMS_API_TOKEN` secreto. Estas credenciales se almacenan de forma segura en el archivo `.env` de la instancia del cliente.
2.  **Sincronización de Entitlements:**
    -   Obtiene la respuesta JSON del LSMS.
    -   Interpreta esta respuesta para determinar el plan de suscripción activo, los módulos que deben estar habilitados (ya sea por inclusión en el plan o por compra individual), y las features específicas que deben estar activas.
3.  **Cacheo Local de Entitlements:**
    -   Almacena la última respuesta válida del LSMS en el sistema de caché de Laravel (`cache()->remember(...)`) con un TTL razonable (ej. 1 a 24 horas).
    -   Esto asegura que la instancia pueda operar y aplicar los permisos correctos incluso si el LSMS está temporalmente inaccesible. La instancia siempre usará los datos cacheados si falla la conexión con el LSMS.
4.  **Integración con Laravel Pennant:**
    -   Es el responsable de traducir los entitlements recibidos en flags de Laravel Pennant.
    -   Por cada módulo: `Pennant::forFeature('module_luinuxscl/crm')->{active ? 'activate' : 'deactivate'}();`
    -   Por cada feature/mejora: `Pennant::forFeature('feature_crm_advanced_reports')->{enabled ? 'activate' : 'deactivate'}();`
    -   También podría almacenar otros datos como `user_limit` en la configuración de la app o en un setting local.
5.  **Programación de Sincronización:**
    -   Puede incluir un comando de Artisan que se ejecuta periódicamente (vía programador de tareas de Laravel) para actualizar los entitlements.
    -   También podría disparar una sincronización cuando un usuario con rol de administrador de la instancia inicia sesión.
6.  **Interfaz de Administrador de Instancia (Opcional pero Recomendado):**
    -   Una sección dentro del panel del cliente (accesible solo por administradores de esa instancia) que podría:
        -   Mostrar el estado actual de la suscripción y los módulos activos.
        -   Listar módulos que están disponibles para activación (según `available_for_activation_modules` del LSMS).
        -   Permitir al administrador de la instancia "Autorizar" la activación de estos nuevos módulos. Esta autorización podría desencadenar:
            -   La ejecución de `php artisan vendor:publish --tag={module-tag}` para los assets del módulo.
            -   La ejecución de `php artisan migrate --path=vendor/{module}/database/migrations`.
            -   El cambio final del flag de Pennant para activar el módulo completamente.

## Uso de Laravel Pennant

Laravel Pennant es la piedra angular para controlar dinámicamente las funcionalidades en cada instancia:

-   **Definición de Features en Pennant:**
    -   El "Módulo de Sistema" es el encargado de definir y actualizar el estado de estos features en la base de datos (o el driver que Pennant utilice).
    -   **Para Módulos:** Se recomienda un feature flag por cada módulo, ej: `module_luinuxscl/crm`, `module_luinuxscl/ai-module`.
    -   **Para Mejoras/Features Específicas:** Flags más granulares, ej: `feature_white_labeling`, `feature_crm_report_export`, `feature_ai_sentiment_analysis`. Podrían incluso tener un prefijo del módulo al que pertenecen si son específicas de él: `feature_crm_detailed_permissions`.
-   **Verificación en el Código:**
    -   Los Service Providers de los módulos verifican `Pennant::active('module_...')` para su activación general ("Modo Bloqueado").
    -   Dentro de los módulos (controladores, componentes Livewire, vistas Blade), se verifica `Pennant::active('feature_...')` para habilitar/deshabilitar sub-funcionalidades específicas.
    -   La lógica del Panel Base también puede usar flags de Pennant para funcionalidades que dependan del plan (ej. `Pennant::active('feature_advanced_branding_options')`).
