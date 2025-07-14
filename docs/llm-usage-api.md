# API de Estadísticas de Uso de LLM

## Descripción

Este documento proporciona información sobre cómo utilizar los endpoints API para registrar y consultar estadísticas de uso de modelos de lenguaje (LLM) en el sistema. Estos endpoints están diseñados para ser utilizados por aplicaciones externas como n8n para registrar y monitorear el consumo de tokens de LLM.

## Autenticación

Todas las solicitudes a la API deben incluir un token de autenticación en el encabezado `Authorization`.

```
Authorization: Bearer {token}
```

## Endpoints

### 1. Registrar Uso de LLM

Registra un nuevo evento de uso de un modelo de lenguaje.

- **URL**: `/api/llm-usage`
- **Método**: `POST`
- **Autenticación requerida**: Sí

#### Cuerpo de la Solicitud

| Parámetro         | Tipo    | Requerido | Descripción                                                                 |
|-------------------|---------|-----------|-----------------------------------------------------------------------------|
| usable_type       | string  | Sí        | Clase completa del modelo al que se asocia el uso (ej: `App\\Models\\User`) |
| usable_id         | integer | Sí        | ID del modelo al que se asocia el uso                                       |
| provider          | string  | Sí        | Proveedor del LLM (valores: `OPENAI`, `ANTHROPIC`, `GOOGLE`, `META`, etc.)  |
| model             | string  | Sí        | Modelo específico utilizado (ej: `gpt-4`, `claude-3-opus`)                  |
| proxy             | string  | No        | Proxy utilizado (valores: `OPENROUTER`, `TOGETHER`, `REPLICATE`, etc.)      |
| task_type         | string  | Sí        | Tipo de tarea (valores: `TEXT`, `IMAGE`, `AUDIO`, `VIDEO`, etc.)            |
| prompt_tokens     | integer | Sí        | Número de tokens usados en el prompt (≥ 0)                                  |
| completion_tokens | integer | Sí        | Número de tokens usados en la respuesta (≥ 0)                               |
| cost              | number  | No        | Costo de la operación (≥ 0)                                                 |
| amount_in_usd     | number  | No        | Monto en dólares (≥ 0)                                                      |
| amount_in_clp     | number  | No        | Monto en pesos chilenos (≥ 0)                                               |
| metadata          | object  | No        | Metadatos adicionales en formato JSON                                       |
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
    "provider": "OPENAI",
    "model": "gpt-4",
    "proxy": "OPENROUTER",
    "task_type": "TEXT",
    "prompt_tokens": 150,
    "completion_tokens": 300,
    "amount_in_usd": 0.10,
    "metadata": {
        "session_id": "abc123",
        "endpoint": "/v1/chat/completions"
    }
}
```

#### Respuesta Exitosa (Código 201)

```json
{
    "message": "Uso registrado exitosamente",
    "data": {
        "id": 1,
        "provider": "OPENAI",
        "model": "gpt-4",
        "proxy": "OPENROUTER",
        "task_type": "TEXT",
        "prompt_tokens": 150,
        "completion_tokens": 300,
        "total_tokens": 450,
        "cost": 0.10,
        "amount_in_usd": 0.10,
        "amount_in_clp": 90.50,
        "metadata": {
            "session_id": "abc123",
            "endpoint": "/v1/chat/completions"
        },
        "created_at": "2025-07-14T15:30:00Z",
        "updated_at": "2025-07-14T15:30:00Z"
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

### 2. Obtener Estadísticas de Uso

Obtiene estadísticas agregadas de uso de LLM.

- **URL**: `/api/llm-usage/stats`
- **Método**: `GET`
- **Autenticación requerida**: Sí

#### Parámetros de Consulta

| Parámetro | Tipo   | Requerido | Descripción                           |
|-----------|--------|-----------|---------------------------------------|
| provider  | string | No        | Filtrar por proveedor (ej: `OPENAI`) |
| model     | string | No        | Filtrar por modelo (ej: `gpt-4`)     |
| task_type | string | No        | Filtrar por tipo de tarea (ej: `TEXT`) |
| proxy     | string | No        | Filtrar por proxy (ej: `OPENROUTER`)  |

#### Ejemplo de Respuesta

```json
{
    "data": [
        {
            "provider": "OPENAI",
            "model": "gpt-4",
            "task_type": "TEXT",
            "proxy": "OPENROUTER",
            "total_prompt_tokens": 1500,
            "total_completion_tokens": 3000,
            "total_tokens": 4500,
            "total_amount_usd": 0.45,
            "total_amount_clp": 400,
            "request_count": 5
        },
        {
            "provider": "ANTHROPIC",
            "model": "claude-2",
            "task_type": "TEXT",
            "proxy": "OPENROUTER",
            "total_prompt_tokens": 2000,
            "total_completion_tokens": 2500,
            "total_tokens": 4500,
            "total_amount_usd": 0.30,
            "total_amount_clp": 270,
            "request_count": 3
        }
    ]
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
    "provider": "OPENAI",
    "model": "gpt-4",
    "proxy": "OPENROUTER",
    "task_type": "TEXT",
    "prompt_tokens": 120,
    "completion_tokens": 240,
    "amount_in_usd": 0.10,
    "metadata": {
        "session_id": "abc123"
    }
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
       "usable_type": "App\\\\\\\\Models\\\\User",
       "usable_id": 1,
       "provider": "OPENAI",
       "model": "gpt-4",
       "proxy": "OPENROUTER",
       "task_type": "TEXT",
       "prompt_tokens": 120,
       "completion_tokens": 240,
       "amount_in_usd": 0.10
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
