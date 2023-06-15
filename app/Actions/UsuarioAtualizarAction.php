<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsuarioAtualizarAction
{
    function executar(array $usuario)
    {
        unset($usuario["password_confirmation"]);
        if ($usuario["password"]) {
            $usuario["password"] = Hash::make($usuario["password"]);
        } else {
            unset($usuario["password"]);
        }
        return User::updateOrCreate(["id" => $usuario["id"]], $usuario);
    }
}
