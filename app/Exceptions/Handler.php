<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use \Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */

    public function render($request, Throwable $exception)
    {
        // Si es una solicitud de API y la excepción es de tipo NotFoundHttpException
        if ($exception instanceof NotFoundHttpException) {
            $status = Response::HTTP_NOT_FOUND;
            $message = "Recurso no encontrado.";
            return response_error($status, $message);
        }

        // Si es una solicitud de API y la excepción es de tipo ModelNotFoundException
        if ($exception instanceof ModelNotFoundException) {
            $status = Response::HTTP_NOT_FOUND;
            $message = "Recurso no encontrado.";
            return response_error($status, $message);
        }
        
        // Si es una solicitud de API y la excepción es de tipo ValidationException
        if ($exception instanceof ValidationException) {
            $status = Response::HTTP_UNPROCESSABLE_ENTITY;
            $message = $exception->validator->errors()->first();
            return response_error($status, $message);
        }

        // Si es una solicitud de API y la excepción es de tipo BadRequestHttpException
        if ($exception instanceof BadRequestHttpException) {
            $status = Response::HTTP_BAD_REQUEST;
            $message = "Petición incorrecta.";
            return response_error($status, $message);
        }

        // Si es una solicitud de API y la excepción es de tipo AuthorizationException
        if ($exception instanceof AuthorizationException) {
            $status = Response::HTTP_FORBIDDEN;
            $message = "No tienes permiso para acceder a este recurso.";
            return response_error($status, $message);
        }
        

        return parent::render($request, $exception);
    }

    public function register()
    {
        $this->reportable(function ( Throwable  $exception) {
            
        });
    }


    protected function unauthenticated($request,AuthenticationException $exception)
    {
        $status = Response::HTTP_UNAUTHORIZED;
        $message = "No tienes acceso. Por favor, inicia sesión.";
        return response_error($status, $message);
    }
}
