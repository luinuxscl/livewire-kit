# 07 - Glosario de Términos de LikePlatform

Este documento define los términos clave utilizados en el contexto del proyecto LikePlatform.

-   **LikePlatform:**

    -   El nombre oficial del producto. Es el panel administrativo personalizable y modular que se entrega a los clientes.

-   **Like:**

    -   La empresa desarrolladora de LikePlatform.
    -   Dominio web: `like.cl`.

-   **luinuxscl:**

    -   El nombre de vendor (y usuario de GitHub) de Luis Sepulveda, desarrollador principal.
    -   Utilizado como namespace para todos los paquetes Laravel desarrollados para LikePlatform (ej. `luinuxscl/crm-module`).

-   **LSMS (LikePlatform Subscription Management Server):**

    -   Servidor Central de Licencias y Suscripciones.
    -   Es una instancia especializada de la propia aplicación LikePlatform, equipada con módulos internos para gestionar clientes, suscripciones, planes, módulos, features y la API de entitlements.
    -   Actúa como la única fuente de verdad para los derechos de las instancias de cliente.

-   **Instancia de Cliente (o Instancia LikePlatform):**

    -   La aplicación LikePlatform específica desplegada y configurada para un cliente final de la empresa "Like".
    -   Opera de forma aislada en su propio entorno de servidor.

-   **Panel Base (LikePlatform Core):**

    -   El núcleo funcional de la aplicación LikePlatform, que incluye gestión de usuarios, autenticación, roles/permisos, y personalización básica de datos y branding.
    -   Es la fundación sobre la que se construyen las soluciones para clientes y sobre la que opera el LSMS.

-   **Módulo Custom:**

    -   Un paquete Laravel desarrollado a medida por "Like" para satisfacer necesidades específicas y únicas de un cliente particular.
    -   Ejemplo: un sistema de gestión de muestras para un biobanco.

-   **Módulo Estándar:**

    -   Un paquete Laravel pre-construido y reutilizable, diseñado para ofrecer una funcionalidad común que puede ser útil para múltiples clientes.
    -   Ejemplos: CRM, Módulo de IA, Módulo de Supervisión.
    -   Puede ser comprado individualmente o incluido en planes de suscripción.

-   **"Módulo de Sistema" (System Connector):**

    -   Un paquete Laravel esencial (ej. `luinuxscl/system-connector`) presente en cada Instancia de Cliente.
    -   Responsable de:
        -   Comunicarse con la API del LSMS.
        -   Sincronizar y cachear los entitlements.
        -   Gestionar la configuración de Laravel Pennant basada en estos entitlements.
        -   Opcionalmente, proveer una interfaz al administrador de la instancia para la activación de módulos.

-   **"Modo Bloqueado":**

    -   El estado de un Módulo Estándar, Módulo Custom o una feature específica dentro de ellos, cuando su funcionalidad no está activa o está restringida debido a la configuración de la suscripción del cliente.
    -   Se implementa técnicamente mediante la verificación de flags de Laravel Pennant en el código del paquete o del panel base.

-   **Entitlements (Derechos):**

    -   El conjunto completo de permisos y configuraciones a los que una Instancia de Cliente tiene derecho, según lo determinado por el LSMS.
    -   Esto incluye el plan de suscripción activo, la lista de módulos habilitados (y su origen: plan o compra), las features específicas activadas, y límites como el número de usuarios.

-   **Pennant (Laravel Pennant):**

    -   El paquete oficial de Laravel utilizado en LikePlatform para la gestión de feature flags.
    -   Permite activar o desactivar dinámicamente funcionalidades sin necesidad de modificar el código fuente directamente o redesplegar.

-   **API de Entitlements:**
    -   El endpoint específico (ej. `GET /api/v1/instance/entitlements`) expuesto por el LSMS que las Instancias de Cliente consumen para obtener sus entitlements.
