<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BuscaObjetosResource extends JsonResource
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
            "id"            => $this->id,
            "nome"          => $this->nome,
            "descricao"     => $this->descricao,
            "entregue"      => $this->entregue,
            "data_cadastro" => substr($this->created_at, 0, 10),
            "imagem"        => config("app.url") . $this->imagem_objeto,
        ];
    }
}
