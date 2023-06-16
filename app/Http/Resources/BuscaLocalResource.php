<?php

namespace App\Http\Resources;

use App\Http\Hateoas\Index as HateoasIndex;
use Illuminate\Http\Resources\Json\JsonResource;

class BuscaLocalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id"        => $this->id,
            "nome"      => $this->nome,
            "endereco"  => $this->endereco,
            "contato"   => $this->contato,
            "descricao" => $this->descricao,
            "imagem"    => $this->imagem_local ? (config("app.url") . $this->imagem_local
            ) : null,
            "links"     => (new HateoasIndex)->links($this->resource),
        ];
    }
}
