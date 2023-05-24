<?php

namespace App\Actions;

use App\Models\Objeto;
use Illuminate\Support\Facades\Auth;

class ObjetoCadastrarAction
{
    /**
     * Cadastra o novo objeto no banco de dados
     *
     * @param array $objetoDados
     * @return Objeto
     */
    public function executar(array $objetoDados): Objeto
    {
        $usuario = Auth::user();
        $local = $usuario->possuiUmLocal;
        $objetoDados["entregue"] = false;
        $objetoDados["local_id"] = $local->id;
        return Objeto::create($objetoDados);
    }
}
