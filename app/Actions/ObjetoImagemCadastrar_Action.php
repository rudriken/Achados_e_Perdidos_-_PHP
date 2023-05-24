<?php

namespace App\Actions;

use App\Models\Objeto;
use Illuminate\Http\UploadedFile;

class ObjetoImagemCadastrar_Action
{
    /**
     * Define uma imagem para um objeto já cadastrado
     *
     * @param UploadedFile $imagem
     * @param Objeto $objeto
     * @return Objeto
     */
    public function executar(UploadedFile $imagem, Objeto $objeto): Objeto
    {
        $objeto->imagem_objeto = $imagem->store("public");
        return Objeto::updateOrCreate(
            ["id" => $objeto->id],
            $objeto->getAttributes()
        );
    }
}
