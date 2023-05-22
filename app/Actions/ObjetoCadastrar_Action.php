<?php

namespace App\Actions;

use App\Http\Requests\Objeto_Request;
use App\Models\Objeto;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ObjetoCadastrar_Action
{
    public function executar(array $dados)
    {
        $usuario = Auth::user();
        $local = $usuario->possuiUmLocal;
        $dados["entregue"] = false;
        $dados["local_id"] = $local->id;
        return Objeto::create($dados);
    }
}
