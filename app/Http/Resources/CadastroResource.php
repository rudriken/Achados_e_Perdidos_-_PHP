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

        $existeChaveImagemLocal = false;
        foreach ($this->getAttributes() as $chave => $_valor) {
            if ($chave === "imagem_local") {
                $existeChaveImagemLocal = true;
                break;
            }
        }

        return [
            "id"        => $this->id,
            "nome"      => $this->nome,
            "endereco"  => $this->endereco,
            "contato"   => $this->contato,
            "descricao" => $this->descricao,
            "imagem"    => $existeChaveImagemLocal
                ? ($this->imagem_local ? config("app.url") . $this->imagem_local : null)
                : null,
            "usuario"   => new CadastroUsuarioResource($this),
            "links"     => (new HateoasLocal)->links($this->resource)
        ];
    }
}
