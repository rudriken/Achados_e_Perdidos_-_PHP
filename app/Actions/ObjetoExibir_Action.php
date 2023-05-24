<?php

namespace App\Actions;

use Illuminate\Support\Facades\Auth;

class ObjetoExibir_Action
{
    public function executar(array $objetoId)
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
