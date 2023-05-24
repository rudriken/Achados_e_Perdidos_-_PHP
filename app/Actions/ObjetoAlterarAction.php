<?php

namespace App\Actions;

use App\Models\Objeto;
use Illuminate\Support\Facades\Auth;

class ObjetoAlterarAction {

    /**
     * Faz a alteração de nome e/ou descrição de um objeto
     *
     * @param array $requisicao
     * @param array $objetoDados
     * @return Objeto|false
     */
    public function executar(array $requisicao, array $objetoDados): Objeto|false
    {
        $usuario = Auth::user();
        $objetos = $usuario->possuiUmLocal->possuiNObjetos;
        foreach ($objetos as $objeto) {
            if ($objeto->id === $objetoDados["id"]) {
                $objeto->nome = $requisicao["nome"];
                $objeto->descricao = $requisicao["descricao"];
                return Objeto::updateOrCreate(
                    ["id" => $objeto->id],
                    $objeto->getAttributes()
                );
            }
        }
        return false;
    }
}
