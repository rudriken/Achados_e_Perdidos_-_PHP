<?php

namespace App\Actions;

use App\Models\Objeto;
use Illuminate\Support\Facades\Auth;

class ObjetoCadastrar_Action
{
    /**
     * Cadastra o novo objeto no banco de dados
     *
     * @param array $dados
     * @return Objeto
     */
    public function executar(array $dados): Objeto
    {
        $usuario = Auth::user();
        $local = $usuario->possuiUmLocal;
        $dados["entregue"] = false;
        $dados["local_id"] = $local->id;
        return Objeto::create($dados);
    }
}
