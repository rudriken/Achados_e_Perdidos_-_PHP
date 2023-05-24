<?php

namespace App\Actions;

use App\Models\Objeto;
use Illuminate\Support\Facades\Auth;

class ObjetoDeletarAction
{
    /**
     * Faz a verificação do usuário logado e exclui o objeto escolhido do banco de dados
     *
     * @param array $objetoDados
     * @return boolean
     */
    public function executar(array $objetoDados): bool
    {
        $usuario = Auth::user();
        $objetos = $usuario->possuiUmLocal->possuiNObjetos;
        foreach ($objetos as $objeto) {
            if ($objeto->id === $objetoDados["id"]) {
                Objeto::destroy($objetoDados["id"]);
                return true;
            }
        }
        return false;
    }
}
