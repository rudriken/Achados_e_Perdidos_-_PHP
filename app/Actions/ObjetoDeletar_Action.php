<?php

namespace App\Actions;

use App\Models\Objeto;
use Illuminate\Support\Facades\Auth;

class ObjetoDeletar_Action
{
    /**
     * Faz a verificação do usuário logado e exclui o objeto escolhido do banco de dados
     *
     * @param array $objetoId
     * @return boolean
     */
    public function executar(array $objetoId): bool
    {
        $usuario = Auth::user();
        $objetos = $usuario->possuiUmLocal->possuiNObjetos;
        foreach ($objetos as $objeto) {
            if ($objeto->id === $objetoId["id"]) {
                Objeto::destroy($objetoId["id"]);
                return true;
            }
        }
        return false;
    }
}
