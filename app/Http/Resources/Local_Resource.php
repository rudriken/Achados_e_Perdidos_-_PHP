<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class Local_Resource extends JsonResource
{
    public static $wrap = "";

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $usuario = User::procurarUsuario($this->getAttributes()["user_id"]);
        $usuario = new Usuario_Resource($usuario);

        return [
            "id"        => $this->getAttributes()["id"],
            "nome"      => $this->getAttributes()["nome"],
            "endereco"  => $this->getAttributes()["endereco"],
            "contato"   => $this->getAttributes()["contato"],
            "descricao" => $this->getAttributes()["descricao"],
            "imagem"    => $this->getAttributes()["imagem_local"],
            "usuario"   => $usuario,
            "links"     => [
                [
                    "type" => "GET",
                    "rel" => "self",
                    "uri" => "/api/locais"
                ],
                [
                    "type" => "PUT",
                    "rel" => "atualizar_local",
                    "uri" => "/api/locais"
                ],
                [
                    "type" => "DELETE",
                    "rel" => "apagar_local",
                    "uri" => "/api/locais"
                ],
                [
                    "type" => "POST",
                    "rel" => "definir_imagem_local",
                    "uri" => "/api/locais/imagem"
                ],
                [
                    "type" => "GET",
                    "rel" => "listar_objetos_local",
                    "uri" => "/api/objetos"
                ],
                [
                    "type" => "POST",
                    "rel" => "adicionar_objeto_local",
                    "uri" => "/api/objetos"
                ]
            ]
        ];
    }
}
