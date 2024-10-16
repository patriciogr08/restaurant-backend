<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProducto extends FormRequest
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
            'idTipoProducto' => 'required|integer|exists:parametros,id',
            'codigo' => 'nullable|string|max:10',
            'nombre' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
            'iva' => 'required|boolean',
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
            'idTipoProducto.required' => 'El tipo de producto es obligatorio.',
            'idTipoProducto.integer' => 'El tipo de producto debe ser un número entero.',
            'idTipoProducto.exists' => 'El tipo de producto seleccionado no es válido.',
            'codigo.string' => 'El código debe ser una cadena de texto.',
            'codigo.max' => 'El código no puede tener más de 10 caracteres.',
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'nombre.string' => 'El nombre del producto debe ser una cadena de texto.',
            'nombre.max' => 'El nombre del producto no puede tener más de 100 caracteres.',
            'precio.required' => 'El precio del producto es obligatorio.',
            'precio.numeric' => 'El precio del producto debe ser un número.',
            'precio.min' => 'El precio del producto no puede ser negativo.',
            'iva.required' => 'El IVA es obligatorio.',
            'iva.boolean' => 'El IVA debe ser verdadero o falso.',
        ];
    }
}
