<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProducto extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'idProducto' => 'nullable|integer|exists:parametros,id',
            'nombre' => 'nullable|string|max:100',
            'precio' => 'nullable|numeric|min:0.00',
            'iva' => 'nullable|boolean',
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
            'idProducto.integer' => 'El campo idProducto debe ser un número entero.',
            'idProducto.exists' => 'El idProducto seleccionado no es válido.',
            'nombre.string' => 'El campo nombre debe ser una cadena de texto.',
            'nombre.max' => 'El campo nombre no debe exceder los 100 caracteres.',
            'precio.numeric' => 'El campo precio debe ser un número.',
            'precio.min' => 'El campo precio debe ser al menos 0.00.',
            'iva.boolean' => 'El campo iva debe ser verdadero o falso.',
        ];
    }
}
