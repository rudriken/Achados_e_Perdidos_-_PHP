<?php

namespace App\Actions;

use App\Models\Local;

class LocalCadastrar_Action {

    private UsuarioCadastrar_Action $usuarioCadastrar;

    public function __construct(UsuarioCadastrar_Action $acao)
    {
        $this->usuarioCadastrar = $acao;
    }

    /**
     * Pega o ID do usuário criado no banco de dados e cria o local nele
     * e o retorna
     *
     * @param array $usuario
     * @param array $local
     * @return Local
     */
    public function executar(array $usuario, array $local): Local
    {
        $user_id = $this->usuarioCadastrar->executar($usuario);
        $local["user_id"] = $user_id;
        return Local::create($local);
    }
}
