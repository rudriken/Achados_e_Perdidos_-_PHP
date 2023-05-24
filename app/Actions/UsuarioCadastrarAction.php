<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsuarioCadastrarAction {

    /**
     * Cadastra o usuário no banco de dados e retorna o ID desse usuário
     *
     * @param array $usuario
     * @return integer
     */
    public function executar(array $usuario): int
    {
        unset($usuario["password_confirmation"]);
        $usuario["password"] = Hash::make($usuario["password"]);
        return User::create($usuario)->id;
    }
}
