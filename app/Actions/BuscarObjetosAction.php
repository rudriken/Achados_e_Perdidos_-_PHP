<?php

namespace App\Actions;

use App\Models\Local;
use Illuminate\Database\Eloquent\Collection;

class BuscarObjetosAction
{

    /**
     * Faz uma busca dos objetos de um local
     *
     * @param Local $local
     * @return Collection
     */
    public function executar(Local $local): Collection
    {
        $objetos = $local->possuiNObjetos;
        return $objetos;
    }
}
