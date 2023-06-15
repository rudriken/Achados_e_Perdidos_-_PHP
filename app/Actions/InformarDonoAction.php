<?php

namespace App\Actions;

use App\Models\Objeto;
use Illuminate\Support\Facades\Auth;

class InformarDonoAction
{
    function executar(array $dados, Objeto $objetoId)
    {
        $usuario = Auth::user();
        $objetos = $usuario->possuiUmLocal->possuiNObjetos;
        foreach ($objetos as $objeto) {
            if (!$objeto->entregue && $objeto->id === $objetoId->id) {
                $objeto->entregue = true;
                $objeto->dono_nome = $dados["dono_nome"];
                $objeto->dono_cpf = $dados["dono_cpf"];
                return $objeto->save();
            }
        }
    }
}
