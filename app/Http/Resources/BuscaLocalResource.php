<?php

namespace App\Http\Resources;

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
        $links = [
            [
                "type" => "GET",
                "rel" => "objetos_local",
                "uri" => "/api/locais/$this->id/objetos"
            ],
        ];

        return [
            "id"        => $this->id,
            "nome"      => $this->nome,
            "endereco"  => $this->endereco,
            "contato"   => $this->contato,
            "descricao" => $this->descricao,
            "imagem"    => config("app.url") . $this->imagem_local,
            "links"     => $links,
        ];
    }
}
