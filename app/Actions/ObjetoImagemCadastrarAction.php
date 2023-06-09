<?php

namespace App\Actions;

use App\Models\Objeto;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class ObjetoImagemCadastrarAction
{
    /**
     * Define uma imagem para um objeto já cadastrado
     *
     * @param UploadedFile $imagem
     * @param Objeto $objetoDados
     * @return Objeto|false
     */
    public function executar(UploadedFile $imagem, Objeto $objetoDados): Objeto|false
    {
        $usuario = Auth::user();
        $objetos = $usuario->possuiUmLocal->possuiNObjetos;
        $objetoEDoUsuario = false;
        foreach ($objetos as $objeto) {
            if ($objeto->id === $objetoDados->id) {
                $objetoEDoUsuario = true;
                break;
            }
        }
        if ($objetoEDoUsuario) {
            $objetoDados->imagem_objeto = $imagem->store("public/objetos");
            return Objeto::updateOrCreate(
                ["id" => $objetoDados->id],
                $objetoDados->getAttributes()
            );
        }
        return false;
    }
}
