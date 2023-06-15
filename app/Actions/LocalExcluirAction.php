<?php

namespace App\Actions;

use App\Models\Local;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LocalExcluirAction
{
    function executar()
    {
        $usuario = Auth::user();
        $local = $usuario->possuiUmLocal;
        $localExcluido = Local::destroy($local->id);
        if ($localExcluido) {
            return User::destroy($usuario->id);
        }
    }
}
