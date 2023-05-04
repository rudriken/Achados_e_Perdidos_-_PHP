<?php

namespace App\Http\Controllers;

use App\Actions\LocalCadastrar_Action;
use App\Http\Requests\Cadastro_Request;
use App\Http\Requests\Imagem_Request;
use App\Http\Resources\Cadastro_Resource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

    public function imagem(Imagem_Request $dados)
    {
        $user = Auth::user();
        $usuario = new User();
        $usuario->setConnection("mysql");
        $usuario->setTable("users");
        $usuario->exists = true;
        $usuario->setAttribute("id", $user->id);
        $usuario->setAttribute("nome", $user->nome);
        $usuario->setAttribute("email", $user->email);
        $usuario->setAttribute("email_verified_at", $user->email_verified_at);
        $usuario->setAttribute("password", $user->password);
        $usuario->setAttribute("remember_token", $user->remember_token);
        $usuario->setAttribute("created_at", $user->created_at);
        $usuario->setAttribute("updated_at", $user->updated_at);
        // $usuario->setRawAttributes($user->getAttributes(), true);
        $local = $usuario->possuiUmLocal()->getResults();
        $local->imagem_local = $dados->imagem_local->store("public");
        $local->save();
        return response()->json([
            "message" => "Imagem definida com sucesso!"
        ]);
    }
}
