# 01 - Arquitectura de LikePlatform

## Stack Tecnológico Principal

-   **Framework Backend:** Laravel 12 (o la versión más reciente estable)
-   **Framework Frontend/UI:** Livewire y FluxUI (o el stack del starter kit base)
-   **Lenguaje de Programación:** PHP (versión compatible con Laravel 12+)
-   **Base de Datos:** Configurable por instancia
-   **Gestor de Paquetes PHP:** Composer
-   **Gestión de Feature Flags:** Laravel Pennant

## Arquitectura General del Sistema

LikePlatform opera bajo un modelo **multi-instancia**:

-   Cada cliente final de "Like" posee su propia instancia dedicada de la aplicación LikePlatform.
-   Cada instancia se ejecuta en un entorno de servidor separado (o contenedor aislado), garantizando el aislamiento completo de datos, configuraciones y recursos entre clientes.

## Componentes Principales

1.  **Instancia de Cliente de LikePlatform (Panel Administrativo del Cliente):**

    -   Es la aplicación Laravel que cada cliente utiliza para gestionar sus operaciones.
    -   Incluye el Panel Base avanzado y los módulos (custom y estándar) que haya adquirido o que estén incluidos en su plan de suscripción.
    -   Contiene un "Módulo de Sistema" para la comunicación con el LSMS.

2.  **Servidor Central de Licencias y Suscripciones (LSMS):**
    -   **Implementación:** Es una instancia especial de la propia aplicación LikePlatform, pero configurada con "Módulos de Desarrollo Interno" para la gestión de todo el ecosistema.
    -   **Alojamiento:** Se ejecuta en un servidor gestionado por "Like" (ej. en `likeplatform.cl` o un subdominio).
    -   **Responsabilidades:**
        -   Gestionar la información de todos los clientes y sus instancias.
        -   Administrar los planes de suscripción, precios y características.
        -   Mantener un catálogo de módulos estándar y personalizados.
        -   Servir como la única fuente de verdad para los entitlements (derechos) de cada instancia de cliente.
        -   Proveer una API RESTful segura para que las instancias de cliente puedan sincronizar sus entitlements.

## Comunicación Instancia Cliente <-> LSMS

-   **Protocolo:** La comunicación se realiza exclusivamente vía una API RESTful provista por el LSMS.
-   **Seguridad:**
    -   Todas las comunicaciones deben ser sobre HTTPS.
    -   Cada instancia de cliente se autentica con el LSMS utilizando un API Token único y secreto.
-   **Flujo de Sincronización:**
    -   Las instancias de cliente contactan al LSMS (ej. al iniciar sesión un admin, mediante un job programado, o bajo demanda) para obtener su configuración de entitlements actualizada.
    -   La respuesta del LSMS (en formato JSON) detalla el plan activo, módulos habilitados, features específicas y otros parámetros (ej. límite de usuarios).
    -   La instancia de cliente cachea esta información localmente para operar incluso si el LSMS está temporalmente inaccesible.

## Módulos como Paquetes Laravel

-   **Vendor Predeterminado:** `luinuxscl` (ver `contexto_creacion_packages.md`).
-   **Estructura:** Cada funcionalidad adicional significativa (CRM, IA, módulo custom para bioterio, etc.) se encapsula como un paquete Laravel independiente.
    -   Esto promueve la modularidad, el desarrollo independiente, el versionado y la reutilización de código.
    -   Facilita la activación/desactivación selectiva de funcionalidades por cliente.
-   **Distribución/Instalación:**
    -   Los paquetes pueden ser instalados en las instancias de cliente vía Composer, idealmente desde un repositorio privado (Satis/Packagist privado) gestionado por "Like".
    -   La activación de un paquete (registro de su ServiceProvider y ejecución de migraciones/publicaciones) es controlada por el "Módulo de Sistema" de la instancia, basado en los entitlements recibidos del LSMS y la posible autorización del admin local.
