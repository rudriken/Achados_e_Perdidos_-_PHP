<?php

namespace App\Http\Controllers;

use App\Actions\ObjetoCadastrar_Action;
use App\Http\Requests\Objeto_Request;
use App\Http\Resources\Objeto_Resource;
use Illuminate\Http\Request;

class Objeto_Controller extends Controller
{
    private ObjetoCadastrar_Action $cadastrar;

    public function __construct(ObjetoCadastrar_Action $acao)
    {
        $this->cadastrar = $acao;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd("cheguei no Controller 'Objeto_Controller'");
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
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
