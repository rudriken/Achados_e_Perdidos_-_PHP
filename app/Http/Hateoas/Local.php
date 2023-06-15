<?php

namespace App\Http\Hateoas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Local extends HateoasBase implements HateoasInterface
{
    public function links(?Model $local): array
    {
        $this->adicionaLink("GET", "self", "mostrar.local");
        $this->adicionaLink("PUT", "atualizar_local", "alterar.local");
        $this->adicionaLink("DELETE", "apagar_local", "apagar.local");
        $this->adicionaLink("POST", "definir_imagem_local", "cadastrar.imagem.local");
        $this->adicionaLink("GET", "listar_objetos_local", "listar.objetos");
        $this->adicionaLink("POST", "adicionar_objeto_local", "cadastrar.objeto");

        return $this->links;
    }
}
