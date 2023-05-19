<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActionStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'numero' => ['nullable', 'max:255', 'string'],
            'fecha' => ['nullable', 'date'],
            'accion' => ['required', 'max:255', 'string'],
            'descripcion' => ['nullable', 'string'],
            'statu_id' => ['required', 'exists:status,id'],
            'prioridad_id' => ['required', 'exists:prioridads,id'],
        ];
    }
}
