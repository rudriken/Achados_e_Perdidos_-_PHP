<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class CadastroUsuario_Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $usuario = User::procurarUsuario($this->user_id);
        return [
            "id" => $usuario->getAttributes()["id"],
            "nome" => $usuario->getAttributes()["nome"],
            "email" => $usuario->getAttributes()["email"],
        ];
    }
}
