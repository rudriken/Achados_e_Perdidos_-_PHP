<?php

namespace App\Http\Controllers;

use App\Http\Resources\CadastroResource;

use Illuminate\Support\Facades\Auth;

class LocalController extends Controller
{
    /**
     * Retorna a busca do local cadastrado pelo usuário logado
     *
     * @return CadastroResource
     */
    public function show(): CadastroResource
    {
        $local = Auth::user()->possuiUmLocal;
        return new CadastroResource($local);
    }
}
