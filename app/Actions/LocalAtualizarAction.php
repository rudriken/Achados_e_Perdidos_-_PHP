<?php

namespace App\Actions;

use App\Models\Local;
use Illuminate\Support\Facades\Auth;

class LocalAtualizarAction
{

    private UsuarioAtualizarAction $usuarioAtualizar;

    function __construct(UsuarioAtualizarAction $acao1)
    {
        $this->usuarioAtualizar = $acao1;
    }

    function executar(array $usuarioDados, array $localDados)
    {
        $usuario = Auth::user();
        $local = $usuario->possuiUmLocal;
        $usuarioDados = ["id" => $usuario->id] + $usuarioDados;
        $this->usuarioAtualizar->executar($usuarioDados);
        return Local::updateOrCreate(["id" => $local["id"]], $localDados);
    }
}
