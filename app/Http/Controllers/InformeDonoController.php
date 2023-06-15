<?php

namespace App\Http\Controllers;

use App\Actions\InformarDonoAction;
use App\Http\Requests\InformeDonoRequest;
use App\Models\Objeto;
use Illuminate\Http\Request;

class InformeDonoController extends Controller
{
    private InformarDonoAction $informeDono;

    function __construct(InformarDonoAction $acao1)
    {
        $this->informeDono = $acao1;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(InformeDonoRequest $request, Objeto $objetoId)
    {
        $resposta = $this->informeDono->executar($request->all(), $objetoId);
        if ($resposta) {
            return response()->json([
                "message" => "Dono do objeto definido com sucesso"
            ], 200);
        } else {
            return response()->json([
                "message" => "Objeto não encontrado"
            ], 404);
        }
    }
}
