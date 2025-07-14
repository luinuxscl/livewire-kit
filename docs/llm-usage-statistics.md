# Gestión de Estadísticas de Uso de LLM

## Tabla de Contenidos
- [Descripción General](#descripción-general)
- [Estructura del Modelo](#estructura-del-modelo)
- [Enums Relacionados](#enums-relacionados)
- [Métodos Principales](#métodos-principales)
- [Scopes de Consulta](#scopes-de-consulta)
- [Relaciones](#relaciones)
- [Ejemplos de Uso](#ejemplos-de-uso)
- [Consideraciones](#consideraciones)
- [Métodos Útiles](#métodos-útiles)
- [Posibles Mejoras](#posibles-mejoras)

## Descripción General

El modelo `LlmUsageStatistic` se encarga de rastrear y almacenar estadísticas de uso de modelos de lenguaje (LLM) en la aplicación. Permite monitorear el consumo de tokens por usuario, modelo y proveedor, lo que resulta útil para facturación, análisis de costos y optimización de recursos.

## Estructura del Modelo

### Tabla: `llm_usage_statistics`

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | bigint | Identificador único |
| `usable_id` | bigint | ID del modelo relacionado |
| `usable_type` | string | Clase del modelo relacionado |
| `provider` | `LlmProviderEnum` | Proveedor del LLM (ej: OpenAI, Anthropic, Google) |
| `model` | string | Modelo específico utilizado (ej: gpt-4, claude-3-opus) |
| `proxy` | `LlmProxyEnum` (nullable) | Proxy utilizado para la conexión (OpenRouter, Together, etc.) |
| `task_type` | `LlmTaskTypeEnum` | Tipo de tarea realizada (texto, imagen, audio, etc.) |
| `prompt_tokens` | integer | Tokens usados en el prompt |
| `completion_tokens` | integer | Tokens usados en la respuesta |
| `total_tokens` | integer | Suma de prompt_tokens + completion_tokens |
| `cost` | decimal(10,2) | Costo de la operación |
| `amount_in_usd` | decimal(10,2) | Monto en dólares |
| `amount_in_clp` | decimal(10,2) | Monto en pesos chilenos |
| `metadata` | json | Metadatos adicionales de la operación |
| `created_at` | timestamp | Fecha de creación |
| `updated_at` | timestamp | Fecha de actualización |

### Índices

- Índice compuesto: `['provider', 'model', 'proxy']`
- Índice compuesto: `['provider', 'task_type']`
- Índice simple: `['proxy']`
- Índice simple: `['task_type']`

## Enums Relacionados

### 1. LlmProviderEnum

Proveedores de modelos de lenguaje soportados:

- `OPENAI`: OpenAI
- `ANTHROPIC`: Anthropic
- `GOOGLE`: Google
- `META`: Meta
- `STABILITY`: Stability AI
- `MIDJOURNEY`: Midjourney
- `MISTRAL`: Mistral
- `COHERE`: Cohere
- `PERPLEXITY`: Perplexity
- `GROQ`: Groq
- `XAI`: xAI
- `DEEPSEEK`: DeepSeek

### 2. LlmProxyEnum

Proxies/intermediarios soportados:

- `OPENROUTER`: OpenRouter
- `TOGETHER`: Together AI
- `REPLICATE`: Replicate
- `HUGGINGFACE`: Hugging Face
- `ANYSCALE`: Anyscale
- `FIREWORKS`: Fireworks AI

### 3. LlmTaskTypeEnum

Tipos de tareas que se pueden realizar:

- `TEXT`: Generación de Texto
- `IMAGE`: Generación de Imágenes
- `AUDIO`: Generación de Audio
- `VIDEO`: Generación de Video
- `EMBEDDING`: Embeddings
- `MODERATION`: Moderación de Contenido
- `FINE_TUNING`: Fine-tuning

Cada tipo de tarea incluye:
- Etiqueta descriptiva
- Ícono asociado
- Unidades de medida típicas
- Método para verificar si usa tokens para precios

## Métodos Principales

### `recordUsage`

Método principal para registrar cualquier uso de LLM.

```php
public static function recordUsage(
    $usable,
    LlmProviderEnum $provider,
    string $model,
    LlmTaskTypeEnum $taskType = LlmTaskTypeEnum::TEXT,
    int $promptTokens = 0,
    int $completionTokens = 0,
    ?float $cost = null,
    ?float $amountInUsd = null,
    ?float $amountInClp = null,
    ?LlmProxyEnum $proxy = null,
    ?array $metadata = null
): self
```

### `recordOpenRouterUsage`

Método específico para registrar usos a través de OpenRouter.

```php
public static function recordOpenRouterUsage(
    $usable,
    LlmProviderEnum $provider,
    string $model,
    LlmTaskTypeEnum $taskType = LlmTaskTypeEnum::TEXT,
    int $promptTokens = 0,
    int $completionTokens = 0,
    ?float $amountInUsd = null,
    ?array $metadata = null
): self
```

### `recordDirectUsage`

Método para registrar usos directos (sin proxy).

```php
public static function recordDirectUsage(
    $usable,
    LlmProviderEnum $provider,
    string $model,
    LlmTaskTypeEnum $taskType = LlmTaskTypeEnum::TEXT,
    int $promptTokens = 0,
    int $completionTokens = 0,
    ?float $amountInUsd = null,
    ?array $metadata = null
): self
```

## Scopes de Consulta

- `byProvider(LlmProviderEnum $provider)`: Filtra por proveedor
- `byProxy(LlmProxyEnum $proxy)`: Filtra por proxy
- `byTaskType(LlmTaskTypeEnum $taskType)`: Filtra por tipo de tarea
- `viaOpenRouter()`: Filtra usos a través de OpenRouter

## Relaciones

### Relación Polimórfica: `usable`

El modelo puede pertenecer a diferentes tipos de modelos mediante una relación polimórfica.

**Ejemplo en el modelo User:**

```php
public function usageStatistics(): \Illuminate\Database\Eloquent\Relations\MorphMany
{
    return $this->morphMany(\App\Models\LlmUsageStatistic::class, 'usable');
}
```

## Ejemplos de Uso

### 1. Registrar Uso Directo (sin proxy)

```php
use App\Models\LlmUsageStatistic;
use App\Enums\LlmProviderEnum;
use App\Enums\LlmTaskTypeEnum;

// Registrar uso directo (sin proxy)
$usage = LlmUsageStatistic::recordDirectUsage(
    usable: $user, // Modelo al que se asocia el uso
    provider: LlmProviderEnum::OPENAI,
    model: 'gpt-4',
    taskType: LlmTaskTypeEnum::TEXT,
    promptTokens: 100,
    completionTokens: 50,
    amountInUsd: 0.10
);
```

### 2. Registrar Uso a través de OpenRouter

```php
use App\Models\LlmUsageStatistic;
use App\Enums\LlmProviderEnum;
use App\Enums\LlmTaskTypeEnum;

$usage = LlmUsageStatistic::recordOpenRouterUsage(
    usable: $user,
    provider: LlmProviderEnum::ANTHROPIC,
    model: 'claude-2',
    taskType: LlmTaskTypeEnum::TEXT,
    promptTokens: 200,
    completionTokens: 100,
    amountInUsd: 0.15
);
```

### 3. Consultar Estadísticas

```php
// Obtener estadísticas de un usuario
$user = User::with('usageStatistics')->find(1);

// Total de tokens usados
echo "Total tokens: " . $user->usageStatistics->sum('total_tokens');

// Uso por proveedor
$byProvider = $user->usageStatistics
    ->groupBy('provider')
    ->map(fn($items) => $items->sum('total_tokens'));

// Uso por tipo de tarea
$byTask = $user->usageStatistics
    ->groupBy('task_type')
    ->map(fn($items) => $items->sum('total_tokens'));
```

### 4. Usando Scopes para Consultas Avanzadas

```php
// Obtener todos los usos de OpenAI a través de OpenRouter
$openAIviaOpenRouter = LlmUsageStatistic::query()
    ->byProvider(LlmProviderEnum::OPENAI)
    ->viaOpenRouter()
    ->get();

// Obtener estadísticas de generación de imágenes
$imageGenerations = LlmUsageStatistic::query()
    ->byTaskType(LlmTaskTypeEnum::IMAGE)
    ->get();
```

## Métodos Útiles

### Obtener Costo Total por Período

```php
/**
 * Obtiene el costo total en un período de tiempo específico
 *
 * @param  string|Carbon  $startDate
 * @param  string|Carbon  $endDate
 * @param  string|null  $currency  'usd' o 'clp', null para ambos
 * @return array
 */
public static function getTotalCostByPeriod($startDate, $endDate, $currency = null)
{
    $query = static::query()
        ->whereBetween('created_at', [$startDate, $endDate]);
    
    $result = [];
    
    if (!$currency || $currency === 'usd') {
        $result['usd'] = (float) $query->sum('amount_in_usd');
    }
    
    if (!$currency || $currency === 'clp') {
        $result['clp'] = (float) $query->sum('amount_in_clp');
    }
    
    return $currency ? $result[$currency] ?? 0 : $result;
}
```

### Obtener Uso Agrupado por Proveedor y Modelo

```php
/**
 * Obtiene el uso agrupado por proveedor y modelo
 *
 * @param  string|Carbon  $startDate
 * @param  string|Carbon  $endDate
 * @return \Illuminate\Database\Eloquent\Collection
 */
public static function getUsageByProviderAndModel($startDate = null, $endDate = null)
{
    $query = static::query()
        ->select([
            'provider',
            'model',
            \DB::raw('SUM(prompt_tokens) as total_prompt_tokens'),
            \DB::raw('SUM(completion_tokens) as total_completion_tokens'),
            \DB::raw('SUM(total_tokens) as total_tokens'),
            \DB::raw('SUM(amount_in_usd) as total_usd'),
            \DB::raw('SUM(amount_in_clp) as total_clp'),
            \DB::raw('COUNT(*) as request_count')
        ])
        ->groupBy(['provider', 'model']);
    
    if ($startDate && $endDate) {
        $query->whereBetween('created_at', [$startDate, $endDate]);
    }
    
    return $query->get();
}
```

### Obtener Estadísticas por Tipo de Tarea

```php
/**
 * Obtiene estadísticas agrupadas por tipo de tarea
 *
 * @param  string|Carbon  $startDate
 * @param  string|Carbon  $endDate
 * @return \Illuminate\Database\Eloquent\Collection
 */
public static function getStatsByTaskType($startDate = null, $endDate = null)
{
    $query = static::query()
        ->select([
            'task_type',
            \DB::raw('SUM(total_tokens) as total_tokens'),
            \DB::raw('SUM(amount_in_usd) as total_usd'),
            \DB::raw('COUNT(*) as request_count')
        ])
        ->groupBy('task_type');
    
    if ($startDate && $endDate) {
        $query->whereBetween('created_at', [$startDate, $endDate]);
    }
    
    return $query->get();
}
```

## Consideraciones

1. **Rendimiento**: 
   - Los índices están optimizados para consultas comunes por proveedor, modelo, proxy y tipo de tarea.
   - Para grandes volúmenes de datos, considera particionar la tabla por rangos de fechas.

2. **Privacidad**: 
   - Los metadatos pueden contener información sensible. Asegúrate de no incluir datos personales identificables (PII) en este campo.
   - Considera implementar enmascaramiento de datos para información sensible.

3. **Monitoreo de Costos**:
   - Los campos `amount_in_usd` y `amount_in_clp` permiten hacer seguimiento de costos en diferentes monedas.
   - Implementa alertas cuando se alcancen ciertos umbrales de gasto.

4. **Extensibilidad**:
   - El campo `metadata` permite almacenar información adicional específica de cada proveedor o caso de uso.
   - La relación polimórfica permite asociar los registros de uso con cualquier modelo de la aplicación.

## Posibles Mejoras

1. **Caché de Estadísticas**
   - Implementar un sistema de caché para métricas frecuentemente consultadas.
   - Usar Redis para almacenar y actualizar estadísticas en tiempo real.

2. **Límites de Uso**
   - Implementar un sistema de cuotas y límites de uso por usuario o equipo.
   - Notificar a los usuarios cuando se acerquen a sus límites.

3. **Dashboard Avanzado**
   - Crear un panel de administración con gráficos y métricas en tiempo real.
   - Incluir comparativas de costos entre diferentes proveedores y modelos.

4. **Análisis de Costo-Efectividad**
   - Implementar análisis para determinar qué modelos ofrecen el mejor rendimiento por costo.
   - Sugerir modelos más económicos para tareas específicas.

5. **Integración con Facturación**
   - Conectar con el sistema de facturación para cargar el uso a las cuentas correspondientes.
   - Generar informes de costos por departamento o proyecto.

6. **Monitoreo de Rendimiento**
   - Registrar tiempos de respuesta de cada proveedor.
   - Identificar cuellos de botella y optimizar el enrutamiento de solicitudes.

7. **Exportación de Datos**
   - Permitir la exportación de datos en formatos como CSV, Excel y PDF.
   - Programar envíos automáticos de informes por correo electrónico.

---

*Última actualización: 2025-07-14*
