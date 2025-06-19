<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLlmUsageRequest;
use App\Http\Resources\LlmUsageStatisticResource;
use App\Models\LlmUsageStatistic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LlmUsageController extends Controller
{
    public function store(StoreLlmUsageRequest $request): JsonResponse
    {
        try {
            // Obtener el modelo usable
            $usable = $request->input('usable_type')::findOrFail($request->input('usable_id'));

            // Registrar el uso directamente usando el modelo
            $statistic = LlmUsageStatistic::recordUsage(
                usable: $usable,
                provider: $request->input('provider'),
                model: $request->input('model'),
                promptTokens: (int)$request->input('prompt_tokens'),
                completionTokens: (int)$request->input('completion_tokens'),
                cost: $request->input('cost'),
                amountInUsd: $request->input('amount_in_usd'),
                amountInClp: $request->input('amount_in_clp')
            );

            // Devolver la respuesta usando el recurso API
            return (new LlmUsageStatisticResource($statistic))
                ->additional(['message' => 'Uso registrado exitosamente'])
                ->response()
                ->setStatusCode(201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al procesar la solicitud.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    public function stats(Request $request): JsonResponse
    {
        $stats = LlmUsageStatistic::query()
            ->getStats(
                $request->query('provider'),
                $request->query('model')
            );

        return response()->json([
            'data' => $stats
        ]);
    }
}
