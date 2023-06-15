<?php

namespace App\Http\Resources;

use App\Http\Hateoas\Local as HateoasLocal;
use Illuminate\Http\Resources\Json\JsonResource;

class CadastroResource extends JsonResource
{
    // public static $wrap = "";

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // $links = [
        //     [
        //         "type" => "GET",
        //         "rel" => "self",
        //         "uri" => "/api/locais"
        //     ],
        //     [
        //         "type" => "PUT",
        //         "rel" => "atualizar_local",
        //         "uri" => "/api/locais"
        //     ],
        //     [
        //         "type" => "DELETE",
        //         "rel" => "apagar_local",
        //         "uri" => "/api/locais"
        //     ],
        //     [
        //         "type" => "POST",
        //         "rel" => "definir_imagem_local",
        //         "uri" => "/api/locais/imagem"
        //     ],
        //     [
        //         "type" => "GET",
        //         "rel" => "listar_objetos_local",
        //         "uri" => "/api/objetos"
        //     ],
        //     [
        //         "type" => "POST",
        //         "rel" => "adicionar_objeto_local",
        //         "uri" => "/api/objetos"
        //     ]
        // ];

        $existeChaveImagemLocal = false;
        foreach ($this->getAttributes() as $chave => $valor) {
            if ($chave === "imagem_local") {
                $existeChaveImagemLocal = true;
                break;
            }
        }

        return [
            "id"        => $this->getAttributes()["id"],
            "nome"      => $this->getAttributes()["nome"],
            "endereco"  => $this->getAttributes()["endereco"],
            "contato"   => $this->getAttributes()["contato"],
            "descricao" => $this->getAttributes()["descricao"],
            "imagem"    => $existeChaveImagemLocal
                ? config("app.url") . $this->getAttributes()["imagem_local"]
                : null,
            "usuario"   => new CadastroUsuarioResource($this),
            "links"     => (new HateoasLocal)->links($this->resource)
        ];
    }
}
