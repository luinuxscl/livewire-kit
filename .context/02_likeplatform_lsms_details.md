# 02 - Detalles del Servidor Central de Licencias y Suscripciones (LSMS) de LikePlatform

## Propósito del LSMS

El LSMS es el cerebro administrativo y de control para todo el ecosistema LikePlatform. Sus funciones principales son:

-   Servir como la **única fuente de verdad** para todos los derechos (entitlements) de cada instancia de cliente.
-   Gestionar de forma centralizada la información de los clientes, sus suscripciones, y los módulos/features a los que tienen acceso.
-   Permitir a "Like" (Luis Sepulveda) administrar y configurar la oferta de servicios de LikePlatform.

## Implementación del LSMS

El LSMS es una instancia especial de la propia aplicación LikePlatform, con las siguientes características:

-   Utiliza el mismo Panel Base avanzado que se entrega a los clientes.
-   Está enriquecida con **"Módulos de Desarrollo Interno"** que proveen la funcionalidad específica del LSMS. Estos módulos no están presentes en las instancias de los clientes.
-   Se accede a través de una interfaz web segura por el personal autorizado de "Like".

## Módulos Internos del LSMS (Ejemplos)

Estos módulos se desarrollan como paquetes Laravel (`luinuxscl/lsms-nombre-modulo`) dentro de la instancia LSMS de LikePlatform:

1.  **`luinuxscl/lsms-client-manager` (Gestión de Clientes):**
    -   ABM (Alta, Baja, Modificación) de empresas clientes.
    -   Gestión de Instancias de Cliente:
        -   Asociar instancias a clientes.
        -   Almacenar URLs de instancia, `INSTANCE_ID` (identificador único de instancia).
        -   Generar y almacenar los `LSMS_API_TOKEN` para cada instancia.
2.  **`luinuxscl/lsms-plan-manager` (Gestión de Planes de Suscripción):**
    -   Definición de planes (PRO, ENTERPRISE, etc.): nombre, identificador, descripción.
    -   Configuración de precios y ciclos de facturación (mensual, anual, semestral).
    -   Asignación de Módulos Estándar incluidos en cada plan.
    -   Asignación de "Mejoras" o Feature Flags generales (ej. `white_labeling`) a cada plan.
    -   Definición de límites (ej. `user_limit`) por plan.
3.  **`luinuxscl/lsms-module-catalog` (Gestión de Módulos Estándar):**
    -   Catálogo de todos los módulos estándar disponibles (`luinuxscl/crm`, `luinuxscl/ai-module`, etc.).
    -   Descripción, versionado (opcional), precio para compra individual (si aplica).
4.  **`luinuxscl/lsms-subscription-engine` (Motor de Suscripciones y Compras):**
    -   Asignación de planes de suscripción a clientes/instancias.
    -   Registro de estado de la suscripción (activa, vencida, cancelada, en prueba).
    -   Gestión de fechas de inicio, fin y renovación.
    -   Registro de compras individuales de módulos estándar por parte de los clientes.
    -   Registro de módulos custom desarrollados para un cliente.
5.  **`luinuxscl/lsms-feature-manager` (Gestión de Features Detalladas):**
    -   Definición de feature flags granulares (ej. `crm_advanced_reports`, `ai_sentiment_analysis`).
    -   Asignación de estas features a planes o a módulos específicos.
    -   Posibilidad de activar features específicas para un cliente particular fuera de su plan (casos especiales).
6.  **`luinuxscl/lsms-api-provider` (API de Entitlements):**
    -   Implementa el endpoint `/api/v1/instance/entitlements`.
    -   Autentica las solicitudes de las instancias de cliente.
    -   Construye y devuelve la respuesta JSON con los entitlements actuales.
7.  **`luinuxscl/lsms-admin-dashboard` (Dashboard de Administración):**
    -   Interfaz para que "Like" visualice el estado general de las suscripciones, clientes activos, ingresos (si se integra facturación), etc.
    -   Herramientas para la gestión operativa del LSMS.

## Modelos de Datos Principales del LSMS (Alto Nivel - Eloquent)

-   `LsmsClient` (o simplemente `Client` si se usa un namespace): `name`, `contact_info`, etc.
-   `LsmsClientInstance` (o `ClientInstance`): `lsms_client_id`, `instance_uuid` (para API), `url`, `api_token` (hasheado).
-   `SubscriptionPlan`: `name`, `identifier_key` (ej. "pro", "enterprise"), `price_monthly`, `price_annually`, `user_limit_default`, `is_active`.
-   `ClientSubscription`: `client_instance_id`, `subscription_plan_id`, `status` (enum: active, past_due, canceled, trial), `start_date`, `end_date`, `current_user_limit` (puede sobrescribir el del plan).
-   `ModuleDefinition` (o `Module`): `package_identifier` (ej. "luinuxscl/crm"), `friendly_name`, `description`, `is_standard` (boolean), `individual_purchase_price` (opcional).
-   `PlanModuleInclusion` (pivot): `subscription_plan_id`, `module_definition_id`.
-   `ClientPurchasedModule`: `client_instance_id`, `module_definition_id`, `purchase_date`.
-   `ClientCustomModule`: `client_instance_id`, `module_definition_id` (para registrarlo), `development_details`.
-   `FeatureDefinition` (o `Feature`): `feature_key` (ej. "white_labeling", "crm_report_export"), `description`, `scope` (general, module_specific).
-   `PlanFeatureInclusion` (pivot): `subscription_plan_id`, `feature_definition_id`.
-   `ClientSpecificFeatureToggle` (pivot): `client_instance_id`, `feature_definition_id`, `is_enabled` (boolean).
