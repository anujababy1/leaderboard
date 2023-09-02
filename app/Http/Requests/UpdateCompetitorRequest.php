<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompetitorRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'      => 'sometimes|required|string|max:255',
            'age'       => 'sometimes|required|integer|min:10|max:120',
            'address'   => 'sometimes|required|string',
            'points'    => 'sometimes|required|numeric|min:0',
        ];
    }
}
