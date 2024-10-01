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
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];

            $data    = User::create($usuario);
            $status  = Response::HTTP_CREATED;
            $message = "Usuario creado correctamente.";


            return response()->json(['message' => 'Usuario registrado correctamente'], Response::HTTP_CREATED);
        } catch (\Throwable $ex) {
            $status  = Response::HTTP_INTERNAL_SERVER_ERROR;
            $message = $ex->getMessage();

            return response_error($status, $message);
        }

        return response_success($data, $status, $message);

    }
 
 // Login de usuarios utilizando el LoginRequest para validación
    public function login(LoginRequest $request)
    {
        try {
            // Intento de autenticación
            if (!auth()->attempt($request->only('username', 'password'))) {
                $status  = Response::HTTP_UNPROCESSABLE_ENTITY;
                $message = "* Credenciales Inválidas.";
 
                return response_error($status, $message);
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
            $status  = Response::HTTP_INTERNAL_SERVER_ERROR;
            $message = "Ocurrió un error al iniciar la sesión de usuario.";

            return response_error($status, $message);

        }
    }

    // Logout de usuarios
    public function logout()
    {
        // Revocar el token de acceso
        auth()->user()->token()->revoke();
        $status  = Response::HTTP_OK;
        $message = "Ha ingresado al sistema satisfactoriamente.";
        
        return response_success( true, $status, $message);
    }
}
