<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function __construct(){
    }
    
     // Registro de usuarios utilizando el RegisterRequest para validación
    public function register(RegisterRequest $request)
    {
        $request->validated();
        try {
            //code...
            $usuario = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];

            $user = User::create($usuario);

            return response()->json(['message' => 'Usuario registrado correctamente'], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al registrar el usuario'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
 
 // Login de usuarios utilizando el LoginRequest para validación
    public function login(LoginRequest $request)
    {
        try {
            // Intento de autenticación
            if (!auth()->attempt($request->only('name', 'password'))) {
                return response()->json(['message' => 'Credenciales no válidas'], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            // Obtener el usuario autenticado
            $user = Auth::user();

            // Crear un token de acceso con Passport
            $token = $user->createToken('authToken');

            return response()->json([
                'accessToken'  => $token->accessToken,
                'createdAt'    => Carbon::parse($token->token->created_at)->toDateTimeString(),
                'expiresAt'    => Carbon::parse($token->token->expires_at)->toDateTimeString()
            ]);
        } catch (\Throwable $ex) {
            //throw $th;
            return response()->json(['message' => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Logout de usuarios
    public function logout()
    {
        // Revocar el token de acceso
        auth()->user()->token()->revoke();
        return response()->json(['message' => 'Sesión cerrada correctamente']);
    }
}
