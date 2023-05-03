<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLogin_Request;

class Auth_Controller extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', "refresh"]]);
    }

    /**
     * Obtém um JWT por meio das credenciais fornecidas.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(AuthLogin_Request $dados)
    {
        $credentials = $dados->only(["email", "password"]);

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->responderComToken($token);
    }

    /**
     * Atualiza o token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->responderComToken(Auth::refresh());
    }

    /**
     * Efetua logout do usuário (invalida o token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Logout realizado com sucesso']);
    }

    // /**
    //  * Get the authenticated User.
    //  *
    //  * @return \Illuminate\Http\JsonResponse
    //  */
    // public function me()
    // {
    //     return response()->json(Auth::user());
    // }

    /**
     * Obtém a estrutura de matriz do token.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responderComToken($token)
    {
        return response()->json([
            'access' => $token,
            'refresh' => $token,
        ]);
    }
}
