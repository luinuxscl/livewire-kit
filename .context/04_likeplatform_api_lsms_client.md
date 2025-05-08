# 04 - Especificación API: LSMS <-> Instancia Cliente de LikePlatform

## Propósito

Esta API permite a las instancias de cliente de LikePlatform sincronizar sus derechos de uso (entitlements) desde el Servidor Central de Licencias y Suscripciones (LSMS).

## Endpoint Principal de Entitlements (en el LSMS)

-   **URL:** `GET /api/v1/instance/entitlements`
    -   La URL base de la API será la del servidor LSMS (ej. `https://api.likeplatform.cl/api/v1/instance/entitlements` o similar).
-   **Método HTTP:** `GET`

## Autenticación

-   **Tipo:** Bearer Token.
-   **Encabezado HTTP:** `Authorization: Bearer <LSMS_API_TOKEN>`
    -   `<LSMS_API_TOKEN>` es un token secreto y único generado por el LSMS para cada instancia de cliente registrada.
    -   Este token debe ser almacenado de forma segura en el archivo `.env` de la instancia de cliente (ej. `LSMS_API_TOKEN=your_secret_token`).

## Request (Enviado por la Instancia Cliente)

-   No se requiere un cuerpo (body) para la solicitud `GET`.
-   La instancia de cliente se identifica implícitamente mediante su `LSMS_API_TOKEN`. El LSMS buscará la instancia asociada a ese token.

## Respuesta Exitosa del LSMS (HTTP 200 OK)

El LSMS responde con un objeto JSON que detalla todos los entitlements actuales de la instancia.

**Estructura del JSON de Respuesta:**

```json
{
    "instance_id": "client-instance-uuid", // UUID único de la instancia, confirmado por el LSMS
    "subscription": {
        // Detalles del plan de suscripción actual de la instancia
        "plan_id": "pro", // Identificador del plan (ej: "free", "pro", "enterprise")
        "plan_name": "Plan Profesional", // Nombre legible del plan
        "status": "active", // Estado de la suscripción: "active", "past_due", "canceled", "trial", "none"
        "expires_at": "2026-05-08T23:59:59Z", // Fecha de expiración en formato ISO 8601 (UTC), o null si no aplica
        "user_limit": 50, // Límite numérico de usuarios para esta instancia
        "can_white_label": true // Booleano indicando si se permite la personalización completa de marca
    },
    "active_modules": [
        // Lista de módulos que deben estar plenamente activos
        {
            "identifier": "luinuxscl/crm", // Identificador del paquete Composer
            "name": "Módulo CRM", // Nombre legible del módulo
            "source": "subscription" // Razón de activación: "subscription" o "purchased"
        },
        {
            "identifier": "luinuxscl/custom-biobanco-xyz",
            "name": "Módulo BioBanco XYZ (Custom)",
            "source": "purchased" // Este es un módulo custom comprado
        },
        {
            "identifier": "luinuxscl/ai-assistant",
            "name": "Asistente IA",
            "source": "subscription"
        }
        // ... más módulos activos
    ],
    "available_for_activation_modules": [
        // Módulos a los que la instancia tiene derecho, pero requieren "autorización" del admin local
        {
            "identifier": "luinuxscl/supervision-dashboard",
            "name": "Panel de Supervisión",
            "requires_admin_approval": true // Siempre true para esta sección
        }
        // ... otros módulos disponibles para activación local
    ],
    "feature_flags": {
        // Objeto con flags para funcionalidades granulares
        "core_panel": {
            // Features del panel base
            "advanced_user_search": true,
            "audit_log_export": false,
            "api_access_for_instance": true // Si la propia instancia puede exponer una API
        },
        "luinuxscl/crm": {
            // Features específicas para el módulo CRM (si está activo)
            "automated_follow_ups": true,
            "custom_crm_fields": true,
            "max_contacts": 10000 // Ejemplo de un límite específico de un feature
        },
        "luinuxscl/ai-assistant": {
            // Features para el módulo de IA
            "sentiment_analysis": true,
            "language_models_available": ["gpt-3.5-turbo", "claude-sonnet"]
        }
        // ... features para otros módulos activos
    },
    "messages_for_admin": [
        // Mensajes opcionales para mostrar al admin de la instancia
        {
            "type": "info", // "info", "warning", "error"
            "content": "Tu plan PRO se renovará automáticamente el 08/06/2025."
        },
        {
            "type": "warning",
            "content": "El módulo 'Reportes Avanzados de Supervisión' requiere el plan ENTERPRISE o una compra adicional."
        }
    ],
    "last_sync_lsms_timestamp": "2025-05-08T17:12:00Z" // Timestamp (UTC) de cuándo se generó esta data en el LSMS
}

## Manejo de Errores (Respuestas del LSMS)

El LSMS debe utilizar códigos de estado HTTP estándar para indicar errores:

- 401 Unauthorized: El LSMS_API_TOKEN es inválido, ha expirado, o no se proporcionó.
- 403 Forbidden: El token es válido, pero la instancia asociada está desactivada o no tiene permiso para acceder a la API.
- 404 Not Found: La instancia asociada al token no pudo ser encontrada en el LSMS (raro si el token es válido).
- 429 Too Many Requests: Si se implementa rate limiting y la instancia excede el límite.
- 500 Internal Server Error: Error inesperado en el servidor LSMS.

El cuerpo de la respuesta de error debería ser un JSON con un mensaje descriptivo:

```json
{
    "error": "true",
    "message": "Token de API inválido o ausente."
}
```

## Consideraciones de Seguridad

- El LSMS_API_TOKEN debe ser tratado como una contraseña y tener suficiente entropía.
- Renovación periódica de tokens o mecanismos para revocarlos desde el LSMS.
- El LSMS debe registrar los intentos de acceso (exitosos y fallidos) a esta API.
