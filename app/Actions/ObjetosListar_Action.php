<?php

namespace App\Actions;

use Illuminate\Support\Facades\Auth;

class ObjetosListar_Action
{
    /**
     * Lista todos os objetos cadastrados para o usuário logado
     *
     * @return array
     */
	public function executar(): array
	{
		$usuario = Auth::user();
		$objetos = $usuario->possuiUmLocal->possuiNObjetos;
		return $objetos;
	}
}
