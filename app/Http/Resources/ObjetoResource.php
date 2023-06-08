<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ObjetoResource extends JsonResource
{
    // static public $wrap = "";

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
                "type"  => "GET",
                "rel"   => "self",
                "uri"   => "/api/objetos/$this->id"
            ],
            [
                "type"  => "PUT",
                "rel"   => "atualizar_objeto",
                "uri"   => "/api/objetos/$this->id"
            ],
            [
                "type"  => "DELETE",
                "rel"   => "apagar_objeto",
                "uri"   => "/api/objetos/$this->id"
            ],
            [
                "type"  => "POST",
                "rel"   => "definir_imagem_objeto",
                "uri"   => "/api/objetos/$this->id/imagem"
            ],
            [
                "type"  => "PATCH",
                "rel"   => "definir_dono_objeto",
                "uri"   => "/api/objetos/$this->id/donos"
            ]
        ];

        return [
            "id"            => $this->id,
            "nome"          => $this->nome,
            "descricao"     => $this->descricao,
            "entregue"      => $this->entregue,
            "data_cadastro" => substr($this->created_at, 0, 10),
            "imagem"        => config("app.url") . $this->imagem_objeto,
            "links"         => $links
        ];
    }
}
