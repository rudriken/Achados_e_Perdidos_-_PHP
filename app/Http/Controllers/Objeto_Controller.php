<?php

namespace App\Http\Controllers;

use App\Models\Objeto;
use Illuminate\Http\JsonResponse;
use App\Actions\ObjetoExibir_Action;
use App\Actions\ObjetoAlterar_Action;
use App\Actions\ObjetoDeletar_Action;
use App\Actions\ObjetosListar_Action;
use App\Http\Requests\Objeto_Request;
use App\Actions\ObjetoCadastrar_Action;
use App\Http\Resources\Objeto_Resource;
use App\Actions\ObjetoImagemCadastrar_Action;
use App\Http\Resources\Objeto_ResourceCollection;


class Objeto_Controller extends Controller
{
    private ObjetoCadastrar_Action $cadastrar;
    private ObjetosListar_Action $listar;
    private ObjetoImagemCadastrar_Action $imagemCadastrar;
    private ObjetoExibir_Action $exibirObjeto;
    private ObjetoAlterar_Action $alterarObjeto;
    private ObjetoDeletar_Action $deletarObjeto;

    public function __construct(
        ObjetoCadastrar_Action $acao1,
        ObjetosListar_Action $acao2,
        ObjetoImagemCadastrar_Action $acao3,
        ObjetoExibir_Action $acao4,
        ObjetoAlterar_Action $acao5,
        ObjetoDeletar_Action $acao6
    ) {
        // $this->middleware('auth:api');
        $this->cadastrar = $acao1;
        $this->listar = $acao2;
        $this->imagemCadastrar = $acao3;
        $this->exibirObjeto = $acao4;
        $this->alterarObjeto = $acao5;
        $this->deletarObjeto = $acao6;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Objeto_ResourceCollection
     */
    public function index(): Objeto_ResourceCollection
    {
        return new Objeto_ResourceCollection($this->listar->executar());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Objeto_Request $request
     * @return Objeto_Resource
     */
    public function store(Objeto_Request $request): Objeto_Resource
    {
        return new Objeto_Resource($this->cadastrar->executar($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param Objeto $objetoId
     * @return Objeto_Resource|JsonResponse
     */
    public function show(Objeto $objetoId): Objeto_Resource|JsonResponse
    {
        $resposta = $this->exibirObjeto->executar($objetoId->getAttributes());
        if ($resposta) {
            return new Objeto_Resource($objetoId);
        }
        return response()->json([
            "message" => "Objeto não encontrado para este usuário"
        ], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Objeto_Request $request
     * @param Objeto $objetoId
     * @return JsonResponse|Objeto_Resource
     */
    public function update(Objeto_Request $request, Objeto $objetoId): JsonResponse|Objeto_Resource
    {
        if ($request->imagem_objeto) {
            $this->imagemCadastrar->executar($request->imagem_objeto, $objetoId);
            return response()->json([
                "message" => "Imagem definida com sucesso!"
            ]);
        }
        $resposta = $this->alterarObjeto->executar(
            $request->all(),
            $objetoId->getAttributes()
        );
        if ($resposta) {
            return new Objeto_Resource($resposta);
        }
        return response()->json([
            "message" => "Objeto não encontrado para este usuário"
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Objeto $objetoId)
    {
        $resposta = $this->deletarObjeto->executar($objetoId->getAttributes());
        if ($resposta) {
            return response()->json([], 204);
        }
        return response()->json([
            "message" => "Objeto não encontrado para este usuário"
        ], 404);
    }
}
