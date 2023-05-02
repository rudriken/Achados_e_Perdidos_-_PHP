<?php

namespace App\Http\Controllers;

use App\Actions\Cadastrar_Action;
use App\Http\Requests\Cadastro_Request;
use App\Http\Resources\Cadastro_Resource;

class Cadastro_Controller extends Controller
{
    private Cadastrar_Action $cadastrar;

    public function __construct(Cadastrar_Action $acao1)
    {
        $this->cadastrar = $acao1;
    }

    public function cadastra(Cadastro_Request $corpo)
    {
        $usuario = (array) $corpo->usuario;
        $local = (array) $corpo->except(["usuario"]);
        return new Cadastro_Resource($this->cadastrar->executar($usuario, $local));
    }
}
