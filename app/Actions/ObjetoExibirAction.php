<?php

namespace App\Actions;

use Illuminate\Support\Facades\Auth;

class ObjetoExibirAction
{
    /**
     * Verifica o usuário logado e exibe ou não o objeto pedido
     *
     * @param array $objetoDados
     * @return array|false
     */
    public function executar(array $objetoDados): array|false
    {
        $usuario = Auth::user();
        $objetos = $usuario->possuiUmLocal->possuiNObjetos;
        $objetoEDoUsuario = false;
        foreach ($objetos as $objeto) {
            if ($objeto && $objeto->id === $objetoDados["id"]) {
                $objetoEDoUsuario = true;
                break;
            }
        }
        if ($objetoEDoUsuario) {
            return $objetoDados;
        }
        return false;
    }
}
