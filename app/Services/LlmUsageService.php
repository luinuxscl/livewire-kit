<?php

namespace App\Services;

use App\Models\LlmUsageStatistic;
use Illuminate\Database\Eloquent\Model;

class LlmUsageService
{
    /**
     * Registra una nueva entrada de uso de LLM asociada a un modelo.
     *
     * @param Model $usable El modelo al que se asocia el uso (e.g., un User, un Product).
     * @param string $provider El proveedor del LLM.
     * @param string $model El modelo específico utilizado.
     * @param int $promptTokens Los tokens enviados en el prompt.
     * @param int $completionTokens Los tokens recibidos en la respuesta.
     * @return LlmUsageStatistic
     */
    public function record(
        Model $usable,
        string $provider,
        string $model,
        int $promptTokens,
        int $completionTokens
    ): LlmUsageStatistic {
        $totalTokens = $promptTokens + $completionTokens;
        return $usable->usageStatistics()->create([
            'provider' => $provider,
            'model' => $model,
            'prompt_tokens' => $promptTokens,
            'completion_tokens' => $completionTokens,
            'total_tokens' => $totalTokens,
        ]);
    }
}
