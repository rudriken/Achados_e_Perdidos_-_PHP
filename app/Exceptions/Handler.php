<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

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
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $erro)
    {
        if ($request->is("api/*")) {
            if ($erro instanceof ValidationException) {
                return response()->json([
                    "HTTP" => 400,
                    "codigo" => "validation_error",
                    "mensagem" => "Erro de validação dos dados enviados",
                ] + $erro->errors(), 400);
            }
            if ($erro instanceof TokenBlacklistedException) {
                return response()->json([
                    "HTTP" => 401,
                    "codigo" => "token_usado",
                    "mensagem" => "O token foi colocado na lista negra",
                ], 401);
            }
            if ($erro instanceof TokenInvalidException) {
                return response()->json([
                    "HTTP" => 401,
                    "codigo" => "token_invalido",
                    "mensagem" => "A assinatura do token não pôde ser verificada",
                ], 401);
            }
            if ($erro instanceof AuthenticationException) {
                return response()->json([
                    "message" => "Token inválido!"
                ], 401);
            }
            if ($erro instanceof ModelNotFoundException) {
                return response()->json([
                    "message" => "Objeto não encontrado"
                ], 404);
            }
            if ($erro instanceof TokenExpiredException) {
                return response()->json([
                    "message" => "Token expirado!"
                ], 401);
            } else {
                dd($erro);
                return response()->json([
                    "HTTP" => 500,
                    "codigo" => "erro_interno",
                    "mensagem" => "Erro não catalogado",
                ], 500);
            }
        }
        return parent::render($request, $erro);
    }
}
