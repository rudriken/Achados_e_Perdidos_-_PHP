<?php

namespace App\Http\Controllers;

use App\Actions\LocalCadastrar_Action;
use App\Http\Requests\Cadastro_Request;
use App\Http\Resources\Cadastro_Resource;

class Cadastro_Controller extends Controller
{
    private LocalCadastrar_Action $cadastrar;

    public function __construct(LocalCadastrar_Action $acao1)
    {
        $this->cadastrar = $acao1;
    }

    /**
     * Cadastra o usuário e o local no banco de dados
     *
     * @param Cadastro_Request $corpo
     * @return Cadastro_Resource
     */
    public function cadastra(Cadastro_Request $corpo): Cadastro_Resource
    {
        $usuario = (array) $corpo->usuario;
        $local = (array) $corpo->except(["usuario"]);
        return new Cadastro_Resource($this->cadastrar->executar($usuario, $local));
    }

    public function imagem()
    {
        dd("cheguei em imagem");
    }
}
