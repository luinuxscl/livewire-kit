<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LlmUsageStatisticResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'provider' => $this->provider,
            'model' => $this->model,
            'prompt_tokens' => (int) $this->prompt_tokens,
            'completion_tokens' => (int) $this->completion_tokens,
            'total_tokens' => (int) $this->total_tokens,
            'cost' => $this->cost !== null ? (float) $this->cost : null,
            'amount_in_usd' => $this->amount_in_usd !== null ? (float) $this->amount_in_usd : null,
            'amount_in_clp' => $this->amount_in_clp !== null ? (float) $this->amount_in_clp : null,
            'usable_type' => $this->usable_type,
            'usable_id' => $this->usable_id,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
            'links' => [
                'self' => route('api.v1.llm-usage.show', $this->id),
                'usable' => $this->when($this->relationLoaded('usable'), function () {
                    return [
                        'url' => route('api.v1.' . strtolower(class_basename($this->usable_type)) . 's.show', $this->usable_id),
                        'type' => $this->usable_type,
                        'id' => $this->usable_id,
                    ];
                }),
            ],
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function with($request): array
    {
        return [
            'meta' => [
                'version' => '1.0.0',
                'api_version' => 'v1',
            ],
        ];
    }
}
