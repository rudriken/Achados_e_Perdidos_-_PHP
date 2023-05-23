<?php

namespace App\Actions;

use App\Models\Objeto;
use Illuminate\Http\UploadedFile;

class ObjetoImagemCadastrar_Action
{
    public function executar(UploadedFile $imagem, Objeto $objeto)
    {
        $objeto->imagem_objeto = $imagem->store("public");
        return Objeto::updateOrCreate(
            ["id" => $objeto->id],
            $objeto->getAttributes()
        );
    }
}
