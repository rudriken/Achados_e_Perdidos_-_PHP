<?php

namespace App\Http\Controllers;

use App\Actions\ObjetoCadastrar_Action;
use App\Actions\ObjetoExibir_Action;
use App\Actions\ObjetoImagemCadastrar_Action;
use App\Actions\ObjetosListar_Action;
use App\Http\Requests\Objeto_Request;
use App\Http\Resources\Objeto_Resource;
use App\Http\Resources\Objeto_ResourceCollection;
use App\Models\Objeto;
use Illuminate\Http\Request;

class Objeto_Controller extends Controller
{
    private ObjetoCadastrar_Action $cadastrar;
    private ObjetosListar_Action $listar;
    private ObjetoImagemCadastrar_Action $imagemCadastrar;
    private ObjetoExibir_Action $exibirObjeto;

    public function __construct(
        ObjetoCadastrar_Action $acao1,
        ObjetosListar_Action $acao2,
        ObjetoImagemCadastrar_Action $acao3,
        ObjetoExibir_Action $acao4
    ) {
        $this->middleware('auth:api');
        $this->cadastrar = $acao1;
        $this->listar = $acao2;
        $this->imagemCadastrar = $acao3;
        $this->exibirObjeto = $acao4;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Objeto_Request $request)
    {
        return new Objeto_Resource($this->cadastrar->executar($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Objeto $objetoId)
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Objeto_Request $request, Objeto $objetoId)
    {
        if ($request->imagem_objeto) {
            $this->imagemCadastrar->executar($request->imagem_objeto, $objetoId);
            return response()->json([
                "message" => "Imagem definida com sucesso!"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
