<?php

namespace App\Actions;

use App\Models\Local;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Cadastrar_Action {
    public function executar(array $usuario, array $local)
    {
        unset($usuario["password_confirmation"]);
        $usuario["password"] = Hash::make($usuario["password"]);
        $user_id = User::create($usuario)->id;
        $local["user_id"] = $user_id;
        return Local::create($local);
    }
}
