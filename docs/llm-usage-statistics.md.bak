# Gestión de Estadísticas de Uso de LLM

## Tabla de Contenidos
- [Descripción General](#descripción-general)
- [Estructura del Modelo](#estructura-del-modelo)
- [Servicio Asociado](#servicio-asociado)
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
| `provider` | string | Proveedor del LLM (ej: OpenAI, Anthropic) |
| `model` | string | Modelo específico utilizado |
| `prompt_tokens` | integer | Tokens usados en el prompt |
| `completion_tokens` | integer | Tokens usados en la respuesta |
| `total_tokens` | integer | Suma de prompt_tokens + completion_tokens |
| `created_at` | timestamp | Fecha de creación |
| `updated_at` | timestamp | Fecha de actualización |

## Servicio Asociado

### `LlmUsageService`

Clase que gestiona la creación de registros de uso de LLM.

#### Métodos

##### `record(Model $usable, string $provider, string $model, int $promptTokens, int $completionTokens): LlmUsageStatistic`

Registra una nueva entrada de uso de LLM.

**Parámetros:**
- `$usable`: Modelo al que se asocia el uso (ej: User, Product)
- `$provider`: Proveedor del LLM (ej: 'OpenAI')
- `$model`: Modelo específico utilizado (ej: 'gpt-4')
- `$promptTokens`: Tokens usados en el prompt
- `$completionTokens`: Tokens usados en la respuesta

**Retorna:**
- Instancia de `LlmUsageStatistic` con los datos registrados

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

### 1. Registrar Uso de LLM

```php
use App\Services\LlmUsageService;
use App\Models\User;

// Obtener el usuario (o cualquier otro modelo)
$user = User::find(1);

// Registrar uso
$llmService = new LlmUsageService();
$statistic = $llmService->record(
    usable: $user,
    provider: 'OpenAI',
    model: 'gpt-4',
    promptTokens: 150,
    completionTokens: 300
);
```

### 2. Obtener Estadísticas de un Usuario

```php
$user = User::with('usageStatistics')->find(1);
$stats = $user->usageStatistics;

echo "Total de tokens usados: " . $stats->sum('total_tokens');
```

### 3. Obtener Estadísticas por Proveedor

```php
$openAIStats = LlmUsageStatistic::where('provider', 'OpenAI')
    ->where('usable_id', $user->id)
    ->where('usable_type', get_class($user))
    ->get();
```

## Métodos Útiles

### Obtener Total de Tokens por Período

```php
public function getTotalTokensByPeriod($startDate, $endDate)
{
    return $this->whereBetween('created_at', [$startDate, $endDate])
        ->sum('total_tokens');
}
```

### Obtener Uso por Modelo

```php
public function getUsageByModel($userId)
{
    return $this->where('usable_id', $userId)
        ->where('usable_type', User::class)
        ->selectRaw('model, SUM(total_tokens) as total_tokens')
        ->groupBy('model')
        ->get();
}
```

## Consideraciones

1. **Rendimiento**: Para grandes volúmenes de datos, considera agregar índices a las columnas frecuentemente consultadas.
2. **Privacidad**: Asegúrate de manejar adecuadamente los datos sensibles que puedan estar asociados a las estadísticas.
3. **Retención**: Implementa un sistema de limpieza de datos antiguos si no son necesarios indefinidamente.

## Posibles Mejoras

1. **Agregación de Datos**: Implementar métodos para obtener totales por período (día, semana, mes).
2. **Límites de Uso**: Añadir funcionalidad para verificar y hacer cumplir límites de uso.
3. **Dashboard**: Crear un panel de administración para visualizar métricas de uso.
4. **Notificaciones**: Implementar alertas cuando se alcancen ciertos umbrales de uso.
5. **Exportación**: Añadir capacidad para exportar reportes en diferentes formatos (CSV, PDF).

---

*Última actualización: 2025-06-17*
