<?php

namespace App\Actions;

use Illuminate\Support\Facades\Auth;

class ObjetoExibir_Action
{
    /**
     * Verifica o usuário logado e exibe ou não o objeto pedido
     *
     * @param array $objetoId
     * @return array|false
     */
    public function executar(array $objetoId): array|false
    {
        $usuario = Auth::user();
        $objetos = $usuario->possuiUmLocal->possuiNObjetos;
        $objetoEDoUsuario = false;
        foreach ($objetos as $objeto) {
            if ($objeto && $objeto->id === $objetoId["id"]) {
                $objetoEDoUsuario = true;
                break;
            }
        }
        if ($objetoEDoUsuario) {
            return $objetoId;
        }
        return false;
    }
}
