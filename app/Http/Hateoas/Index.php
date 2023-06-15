<?php

namespace App\Http\Hateoas;

use App\Http\Hateoas\HateoasBase;
use App\Http\Hateoas\HateoasInterface;
use Illuminate\Database\Eloquent\Model;

class Index extends HateoasBase implements HateoasInterface
{
    function links(?Model $nomeBuscado): array
    {
        $this->adicionaLink("GET", "objetos_local", "buscar.objetos", ["localId" => $nomeBuscado->id]);

        return $this->links;
    }
}
