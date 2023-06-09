<?php

namespace App\Http\Controllers;

use App\Actions\BuscarObjetosAction;
use App\Http\Resources\BuscaObjetosResourceCollection;
use App\Models\Local;
// use Illuminate\Http\Request;

class BuscaObjetosController extends Controller
{
    private BuscarObjetosAction $buscarObjetos;

    public function __construct(BuscarObjetosAction $acao1)
    {
        $this->buscarObjetos = $acao1;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Local $localId)
    {
        $objetos = $this->buscarObjetos->executar($localId);
        return new BuscaObjetosResourceCollection($objetos);
    }
}
