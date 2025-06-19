<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class LlmUsageStatistic extends Model
{
    use HasFactory;

    protected $table = 'llm_usage_statistics';

    protected $fillable = [
        'usable_id',
        'usable_type',
        'provider',
        'model',
        'prompt_tokens',
        'completion_tokens',
        'total_tokens',
        'cost',
        'amount_in_usd',
        'amount_in_clp',
    ];

    protected $casts = [
        'prompt_tokens' => 'integer',
        'completion_tokens' => 'integer',
        'total_tokens' => 'integer',
        'cost' => 'decimal:10',
        'amount_in_usd' => 'decimal:2',
        'amount_in_clp' => 'decimal:2',
    ];
    
    // Proveedores permitidos
    const PROVIDERS = ['OpenAI', 'Anthropic', 'Google', 'Meta'];

    /**
     * Obtiene el modelo padre (User, Product, etc.) al que pertenece la estadística.
     */
    public function usable(): MorphTo
    {
        return $this->morphTo();
    }
    
    /**
     * Registrar un nuevo uso de LLM
     *
     * @param mixed $usable Modelo relacionado (User, Product, etc.)
     * @param string $provider Proveedor del modelo (ej: 'OpenAI')
     * @param string $model Nombre del modelo utilizado
     * @param int $promptTokens Tokens usados en el prompt
     * @param int $completionTokens Tokens usados en la respuesta
     * @param float|null $cost Costo exacto de la operación
     * @param float|null $amountInUsd Monto en dólares
     * @param float|null $amountInClp Monto en pesos chilenos
     * @return static
     */
    public static function recordUsage(
        $usable,
        string $provider,
        string $model,
        int $promptTokens,
        int $completionTokens,
        ?float $cost = null,
        ?float $amountInUsd = null,
        ?float $amountInClp = null
    ): self {
        return static::create([
            'usable_type' => get_class($usable),
            'usable_id' => $usable->id,
            'provider' => $provider,
            'model' => $model,
            'prompt_tokens' => $promptTokens,
            'completion_tokens' => $completionTokens,
            'total_tokens' => $promptTokens + $completionTokens,
            'cost' => $cost,
            'amount_in_usd' => $amountInUsd,
            'amount_in_clp' => $amountInClp,
        ]);
    }
    
    /**
     * Obtener estadísticas agregadas
     *
     * @param string|null $provider Filtrar por proveedor
     * @param string|null $model Filtrar por modelo
     * @return \Illuminate\Database\Eloquent\Model|object|static|null
     */
    public function scopeGetStats($query, ?string $provider = null, ?string $model = null)
    {
        if ($provider) {
            $query->where('provider', $provider);
        }
        
        if ($model) {
            $query->where('model', $model);
        }

        return $query->selectRaw('
            SUM(prompt_tokens) as total_prompt_tokens,
            SUM(completion_tokens) as total_completion_tokens,
            SUM(total_tokens) as total_tokens,
            SUM(COALESCE(cost, 0)) as total_cost,
            SUM(COALESCE(amount_in_usd, 0)) as total_amount_usd,
            SUM(COALESCE(amount_in_clp, 0)) as total_amount_clp,
            COUNT(*) as total_requests
        ')->first();
    }
}
