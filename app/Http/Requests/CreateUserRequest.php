<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => 'required|string|max:15',
            'nombres'  => 'required|string|max:50',
            'apellidos'=> 'required|string|max:50',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'idPerfil' => 'nullable|integer|exists:perfiles,id',
        ];
    }
    

    public function messages()
    {
        return [
            'username.required' => 'El nombre de usuario es obligatorio.',
            'username.string'   => 'El nombre de usuario debe ser una cadena de texto.',
            'username.max'      => 'El nombre de usuario no puede tener más de 15 caracteres.',
            
            'nombres.required'  => 'Los nombres son obligatorios.',
            'nombres.string'    => 'Los nombres deben ser una cadena de texto.',
            'nombres.max'       => 'Los nombres no pueden tener más de 50 caracteres.',
            
            'apellidos.required'=> 'Los apellidos son obligatorios.',
            'apellidos.string'  => 'Los apellidos deben ser una cadena de texto.',
            'apellidos.max'     => 'Los apellidos no pueden tener más de 50 caracteres.',
            
            'email.required'    => 'El correo electrónico es obligatorio.',
            'email.string'      => 'El correo electrónico debe ser una cadena de texto.',
            'email.email'       => 'El correo electrónico debe ser una dirección de correo válida.',
            'email.max'         => 'El correo electrónico no puede tener más de 255 caracteres.',
            'email.unique'      => 'El correo electrónico ya está registrado.',
            
            'password.required' => 'La contraseña es obligatoria.',
            'password.string'   => 'La contraseña debe ser una cadena de texto.',
            'password.min'      => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed'=> 'La confirmación de la contraseña no coincide.',
            
            'idPerfil.integer'  => 'El ID del perfil debe ser un número entero.',
            'idPerfil.exists'   => 'El perfil seleccionado no existe.',
        ];
    }


}
