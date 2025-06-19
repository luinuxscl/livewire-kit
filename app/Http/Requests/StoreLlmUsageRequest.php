<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLlmUsageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Por defecto, cualquier usuario autenticado puede hacer esta solicitud
        // Se puede personalizar según las necesidades de autorización
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'usable_type' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    if (!class_exists($value)) {
                        $fail("La clase especificada no existe.");
                    } elseif (!is_subclass_of($value, 'Illuminate\\Database\\Eloquent\\Model')) {
                        $fail("La clase especificada no es un modelo Eloquent válido.");
                    }
                },
            ],
            'usable_id' => 'required|integer|exists:' . request('usable_type') . ',id',
            'provider' => [
                'required',
                'string',
                Rule::in(\App\Models\LlmUsageStatistic::PROVIDERS)
            ],
            'model' => 'required|string|max:255',
            'prompt_tokens' => 'required|integer|min:0',
            'completion_tokens' => 'required|integer|min:0',
            'cost' => 'nullable|numeric|min:0',
            'amount_in_usd' => 'nullable|numeric|min:0',
            'amount_in_clp' => 'nullable|numeric|min:0',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'usable_type.required' => 'El tipo de modelo es obligatorio.',
            'usable_id.required' => 'El ID del modelo es obligatorio.',
            'provider.required' => 'El proveedor es obligatorio.',
            'provider.in' => 'El proveedor seleccionado no es válido.',
            'model.required' => 'El modelo es obligatorio.',
            'prompt_tokens.required' => 'El número de tokens del prompt es obligatorio.',
            'prompt_tokens.min' => 'El número de tokens del prompt debe ser mayor o igual a 0.',
            'completion_tokens.required' => 'El número de tokens de completado es obligatorio.',
            'completion_tokens.min' => 'El número de tokens de completado debe ser mayor o igual a 0.',
            'cost.numeric' => 'El costo debe ser un número válido.',
            'cost.min' => 'El costo no puede ser negativo.',
            'amount_in_usd.numeric' => 'El monto en USD debe ser un número válido.',
            'amount_in_usd.min' => 'El monto en USD no puede ser negativo.',
            'amount_in_clp.numeric' => 'El monto en CLP debe ser un número válido.',
            'amount_in_clp.min' => 'El monto en CLP no puede ser negativo.',
        ];
    }
}
