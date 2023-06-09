<?php

namespace App\Http\Controllers;

use App\Models\Objeto;
use Illuminate\Http\JsonResponse;
use App\Actions\ObjetoExibirAction;
use App\Actions\ObjetoAlterarAction;
use App\Actions\ObjetoDeletarAction;
use App\Actions\ObjetosListarAction;
use App\Http\Requests\ObjetoRequest;
use App\Actions\ObjetoCadastrarAction;
use App\Http\Resources\ObjetoResource;
use App\Actions\ObjetoImagemCadastrarAction;
use App\Http\Resources\ObjetoResourceCollection;


class ObjetoController extends Controller
{
    private ObjetoCadastrarAction $cadastrar;
    private ObjetosListarAction $listar;
    private ObjetoImagemCadastrarAction $imagemCadastrar;
    private ObjetoExibirAction $exibirObjeto;
    private ObjetoAlterarAction $alterarObjeto;
    private ObjetoDeletarAction $deletarObjeto;

    public function __construct(
        ObjetoCadastrarAction $acao1,
        ObjetosListarAction $acao2,
        ObjetoImagemCadastrarAction $acao3,
        ObjetoExibirAction $acao4,
        ObjetoAlterarAction $acao5,
        ObjetoDeletarAction $acao6
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
     * @return ObjetoResourceCollection|array
     */
    public function index(): ObjetoResourceCollection|array
    {
        $resposta = $this->listar->executar();
        return new ObjetoResourceCollection($resposta);
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
     * @param ObjetoRequest $request
     * @return ObjetoResource
     */
    public function store(ObjetoRequest $request): ObjetoResource
    {
        return new ObjetoResource($this->cadastrar->executar($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param Objeto $objetoId
     * @return ObjetoResource|JsonResponse
     */
    public function show(Objeto $objetoId): ObjetoResource|JsonResponse
    {
        $resposta = $this->exibirObjeto->executar($objetoId->getAttributes());
        if ($resposta) {
            return new ObjetoResource($objetoId);
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
     * @param ObjetoRequest $request
     * @param Objeto $objetoId
     * @return JsonResponse|ObjetoResource
     */
    public function update(ObjetoRequest $request, Objeto $objetoId): JsonResponse|ObjetoResource
    {
        if ($request->imagem_objeto) {
            $resposta = $this->imagemCadastrar->executar($request->imagem_objeto, $objetoId);
            if ($resposta) {
                return response()->json([
                    "message" => "Imagem definida com sucesso!"
                ]);
            }
            return response()->json([
                "message" => "Objeto não encontrado para este usuário"
            ], 404);
        }
        $resposta = $this->alterarObjeto->executar(
            $request->all(),
            $objetoId->getAttributes()
        );
        if ($resposta) {
            return new ObjetoResource($resposta);
        }
        return response()->json([
            "message" => "Objeto não encontrado para este usuário"
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Objeto $objetoId
     * @return JsonResponse
     */
    public function destroy(Objeto $objetoId): JsonResponse
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
