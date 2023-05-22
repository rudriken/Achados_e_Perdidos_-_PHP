<?php

namespace App\Actions;

use Illuminate\Support\Facades\Auth;

class ObjetosListar_Action {
    public function executar()
    {
        $usuario = Auth::user();
        $objetos = $usuario->possuiUmLocal->possuiVariosObjetos;
        return $objetos;
    }
}
