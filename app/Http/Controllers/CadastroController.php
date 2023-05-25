<?php

namespace App\Http\Controllers;

use App\Actions\LocalCadastrarAction;
use App\Http\Requests\CadastroRequest;
use App\Http\Requests\ImagemRequest;
use App\Http\Resources\CadastroResource;
use App\Models\User;
use Illuminate\Http\UploadedFile;
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

    public function cadastraImagem(ImagemRequest $dados)
    {
        $usuario = Auth::user();
        $local = $usuario->possuiUmLocal;
        if ($local) {
            $local->imagem_local = $dados->imagem_local->store("public/locais");
            $local->save();
            return response()->json([
                "message" => "Imagem definida com sucesso!"
            ]);
        }
        return response()->json([
            "message" => "Usuario não possui local cadastrado",
        ]);
    }
}
