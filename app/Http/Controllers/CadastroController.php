<?php

namespace App\Http\Controllers;

use App\Actions\LocalCadastrarAction;
use App\Http\Requests\CadastroRequest;
use App\Http\Requests\ImagemRequest;
use App\Http\Resources\CadastroResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CadastroController extends Controller
{
    private LocalCadastrarAction $cadastrar;

    public function __construct(LocalCadastrarAction $acao1)
    {
        $this->cadastrar = $acao1;
    }

    /**
     * Cadastra o usuário e o local no banco de dados
     *
     * @param Cadastro_Request $corpo
     * @return CadastroResource
     */
    public function cadastra(CadastroRequest $corpo): CadastroResource
    {
        $usuario = (array) $corpo->usuario;
        $local = (array) $corpo->except(["usuario"]);
        return new CadastroResource($this->cadastrar->executar($usuario, $local));
    }

    public function imagem(ImagemRequest $dados)
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
