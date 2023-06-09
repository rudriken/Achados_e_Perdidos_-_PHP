<?php

namespace App\Http\Controllers;

use App\Actions\BuscarLocaisAction;
use App\Http\Resources\BuscaLocalResourceCollection;
use Illuminate\Http\Request;

class BuscaLocaisController extends Controller
{

    private BuscarLocaisAction $buscarLocais;

    public function __construct(BuscarLocaisAction $acao1)
    {
        $this->buscarLocais = $acao1;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $nome = $request->query("nome");
        $locais = $this->buscarLocais->executar($nome);
        return new BuscaLocalResourceCollection($locais);
    }
}
