<?php

namespace App\Http\Controllers;

use App\Actions\Cadastrar_Action;
use App\Http\Requests\Cadastro_Request;
use Illuminate\Http\Request;

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
        return $this->cadastrar->executar($usuario, $local);
    }
}
