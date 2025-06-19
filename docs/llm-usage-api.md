# API de Estadísticas de Uso de LLM

## Descripción

Este documento proporciona información sobre cómo utilizar el endpoint API para registrar estadísticas de uso de modelos de lenguaje (LLM) en el sistema. Este endpoint está diseñado para ser utilizado por aplicaciones externas como n8n para registrar el consumo de tokens de LLM.

## Autenticación

Todas las solicitudes a la API deben incluir un token de autenticación en el encabezado `Authorization`.

```
Authorization: Bearer {token}
```

## Endpoint

### Registrar Uso de LLM

Registra un nuevo evento de uso de un modelo de lenguaje.

- **URL**: `/api/llm-usage`
- **Método**: `POST`
- **Autenticación requerida**: Sí

#### Cuerpo de la Solicitud

| Parámetro         | Tipo    | Requerido | Descripción                                                                 |
|-------------------|---------|-----------|-----------------------------------------------------------------------------|
| usable_type       | string  | Sí        | Clase completa del modelo al que se asocia el uso (ej: `App\\Models\\User`) |
| usable_id         | integer | Sí        | ID del modelo al que se asocia el uso                                       |
| provider          | string  | Sí        | Proveedor del LLM (ej: `OpenAI`, `Anthropic`, `Google`, `Meta`)             |
| model             | string  | Sí        | Modelo específico utilizado (ej: `gpt-4`, `claude-3-opus`)                  |
| prompt_tokens     | integer | Sí        | Número de tokens usados en el prompt (≥ 0)                                  |
| completion_tokens | integer | Sí        | Número de tokens usados en la respuesta (≥ 0)                               |


#### Ejemplo de Solicitud

```http
POST /api/llm-usage HTTP/1.1
Host: tu-dominio.com
Authorization: Bearer tu-token-de-acceso
Content-Type: application/json

{
    "usable_type": "App\\Models\\User",
    "usable_id": 1,
    "provider": "OpenAI",
    "model": "gpt-4",
    "prompt_tokens": 150,
    "completion_tokens": 300
}
```

#### Respuesta Exitosa (Código 201)

```json
{
    "message": "Registro de uso de LLM creado exitosamente.",
    "data": {
        "id": 1,
        "usable_type": "App\\Models\\User",
        "usable_id": 1,
        "provider": "OpenAI",
        "model": "gpt-4",
        "prompt_tokens": 150,
        "completion_tokens": 300,
        "total_tokens": 450,
        "created_at": "2025-06-17T16:53:48.000000Z",
        "updated_at": "2025-06-17T16:53:48.000000Z"
    }
}
```

#### Errores

**Código 401 - No autorizado**
```json
{
    "message": "No autenticado."
}
```

**Código 422 - Error de validación**
```json
{
    "message": "Los datos proporcionados no son válidos.",
    "errors": {
        "provider": [
            "El proveedor seleccionado no es válido."
        ]
    }
}
```

## Ejemplos de Uso

### Con cURL

```bash
curl -X POST \
  https://tu-dominio.com/api/llm-usage \
  -H 'Authorization: Bearer tu-token-de-acceso' \
  -H 'Content-Type: application/json' \
  -d '{
    "usable_type": "App\\\\Models\\\\User",
    "usable_id": 1,
    "provider": "OpenAI",
    "model": "gpt-4",
    "prompt_tokens": 120,
    "completion_tokens": 240
  }'
```

### Con n8n

1. Agrega un nodo **HTTP Request** a tu flujo de trabajo.
2. Configúralo de la siguiente manera:
   - **Authentication**: OAuth2
   - **URL**: `https://tu-dominio.com/api/llm-usage`
   - **Method**: POST
   - **Headers**:
     - `Content-Type`: `application/json`
     - `Accept`: `application/json`
   - **Body**:
     ```json
     {
       "usable_type": "App\\\\Models\\\\User",
       "usable_id": 1,
       "provider": "OpenAI",
       "model": "gpt-4",
       "prompt_tokens": 120,
       "completion_tokens": 240
     }
     ```
3. Configura la autenticación OAuth2 según corresponda.

## Límites de Tasa (Rate Limiting)

El endpoint tiene configurado un límite de 60 solicitudes por minuto por IP. Si se excede este límite, la API devolverá un código de estado 429 con el siguiente cuerpo:

```json
{
    "message": "Demasiados intentos. Por favor, inténtalo de nuevo más tarde."
}
```

## Seguridad

- Todas las solicitudes deben realizarse a través de HTTPS.
- Los tokens de autenticación nunca deben exponerse en el lado del cliente.
- Se recomienda implementar políticas de seguridad adicionales en el lado del cliente.

## Soporte

Para problemas o preguntas, contacta al equipo de soporte en soporte@tudominio.com.
