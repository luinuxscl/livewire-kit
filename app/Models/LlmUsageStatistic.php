<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Enums\LlmProviderEnum;
use App\Enums\LlmProxyEnum;
use App\Enums\LlmTaskTypeEnum;

class LlmUsageStatistic extends Model
{
    use HasFactory;

    protected $table = 'llm_usage_statistics';

    protected $fillable = [
        'usable_id',
        'usable_type',
        'provider',
        'model',
        'proxy',
        'task_type',
        'prompt_tokens',
        'completion_tokens',
        'total_tokens',
        'cost',
        'amount_in_usd',
        'amount_in_clp',
        'metadata',
    ];

    protected $casts = [
        'provider' => LlmProviderEnum::class,
        'proxy' => LlmProxyEnum::class,
        'task_type' => LlmTaskTypeEnum::class,
        'prompt_tokens' => 'integer',
        'completion_tokens' => 'integer',
        'total_tokens' => 'integer',
        'cost' => 'decimal:10',
        'amount_in_usd' => 'decimal:2',
        'amount_in_clp' => 'decimal:2',
        'metadata' => 'array',
    ];

    /**
     * Obtiene el modelo padre al que pertenece la estadística.
     */
    public function usable(): MorphTo
    {
        return $this->morphTo();
    }
    
    /**
     * Registrar un nuevo uso de LLM
     */
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
    ): self {
        return static::create([
            'usable_type' => get_class($usable),
            'usable_id' => $usable->id,
            'provider' => $provider,
            'model' => $model,
            'proxy' => $proxy,
            'task_type' => $taskType,
            'prompt_tokens' => $promptTokens,
            'completion_tokens' => $completionTokens,
            'total_tokens' => $promptTokens + $completionTokens,
            'cost' => $cost,
            'amount_in_usd' => $amountInUsd,
            'amount_in_clp' => $amountInClp,
            'metadata' => $metadata,
        ]);
    }

    /**
     * Registrar uso específico via OpenRouter
     */
    public static function recordOpenRouterUsage(
        $usable,
        LlmProviderEnum $provider,
        string $model,
        LlmTaskTypeEnum $taskType = LlmTaskTypeEnum::TEXT,
        int $promptTokens = 0,
        int $completionTokens = 0,
        ?float $amountInUsd = null,
        ?array $metadata = null
    ): self {
        return static::recordUsage(
            usable: $usable,
            provider: $provider,
            model: $model,
            taskType: $taskType,
            promptTokens: $promptTokens,
            completionTokens: $completionTokens,
            amountInUsd: $amountInUsd,
            proxy: LlmProxyEnum::OPENROUTER,
            metadata: $metadata
        );
    }

    /**
     * Registrar uso directo (sin proxy)
     */
    public static function recordDirectUsage(
        $usable,
        LlmProviderEnum $provider,
        string $model,
        LlmTaskTypeEnum $taskType = LlmTaskTypeEnum::TEXT,
        int $promptTokens = 0,
        int $completionTokens = 0,
        ?float $amountInUsd = null,
        ?array $metadata = null
    ): self {
        return static::recordUsage(
            usable: $usable,
            provider: $provider,
            model: $model,
            taskType: $taskType,
            promptTokens: $promptTokens,
            completionTokens: $completionTokens,
            amountInUsd: $amountInUsd,
            proxy: null,
            metadata: $metadata
        );
    }

    // Resto de métodos con tipos actualizados...
    
    public function scopeByProvider($query, LlmProviderEnum $provider)
    {
        return $query->where('provider', $provider);
    }

    public function scopeByProxy($query, LlmProxyEnum $proxy)
    {
        return $query->where('proxy', $proxy);
    }

    public function scopeByTaskType($query, LlmTaskTypeEnum $taskType)
    {
        return $query->where('task_type', $taskType);
    }

    public function scopeViaOpenRouter($query)
    {
        return $query->where('proxy', LlmProxyEnum::OPENROUTER);
    }

    /**
     * Obtener el nombre completo del modelo (incluyendo proxy si existe)
     */
    public function getFullModelNameAttribute(): string
    {
        $base = "{$this->provider->value}/{$this->model}";
        
        return $this->proxy ? "{$base} (via {$this->proxy->label()})" : $base;
    }

    /**
     * Verificar si el request fue via OpenRouter
     */
    public function isViaOpenRouter(): bool
    {
        return $this->proxy === LlmProxyEnum::OPENROUTER;
    }
}