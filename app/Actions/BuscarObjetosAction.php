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
     * @return array<Collection>
     */
    public function executar(Local $local): array
    {
        $objetos = $local->possuiNObjetos;
        $objetosDisponiveis = [];
        foreach ($objetos as $objeto) {
            if (!$objeto->entregue) {
                $objetosDisponiveis = array_merge($objetosDisponiveis, [$objeto]);
            }
        }
        return $objetosDisponiveis;
    }
}
