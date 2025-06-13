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
    ];

    protected $casts = [
        'prompt_tokens' => 'integer',
        'completion_tokens' => 'integer',
        'total_tokens' => 'integer',
    ];

    /**
     * Obtiene el modelo padre (User, Product, etc.) al que pertenece la estadística.
     */
    public function usable(): MorphTo
    {
        return $this->morphTo();
    }
}
