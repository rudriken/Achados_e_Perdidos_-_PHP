<?php

namespace App\Http\Hateoas;

use Illuminate\Database\Eloquent\Model;

class Objeto extends HateoasBase implements HateoasInterface
{
    public function links(?Model $objeto): array
    {
        $this->adicionaLink(
            "GET",
            "self",
            "exibir.objeto",
            ["objetoId" => $objeto->id]
        );
        $this->adicionaLink(
            "PUT",
            "atualizar_objeto",
            "alterar.objeto",
            ["objetoId" => $objeto->id]
        );
        $this->adicionaLink(
            "DELETE",
            "apagar_objeto",
            "deletar.objeto",
            ["objetoId" => $objeto->id]
        );
        $this->adicionaLink(
            "POST",
            "definir_imagem_objeto",
            "cadastrar.imagem.objeto",
            ["objetoId" => $objeto->id]
        );
        $this->adicionaLink(
            "POST",
            "definir_dono_objeto",
            "informar.dono",
            ["objetoId" => $objeto->id]
        );



        return $this->links;
    }
}
