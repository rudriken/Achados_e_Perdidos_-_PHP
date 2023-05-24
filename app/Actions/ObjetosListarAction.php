<?php

namespace App\Actions;

use Illuminate\Support\Facades\Auth;

class ObjetosListarAction
{
	/**
	 * Lista todos os objetos cadastrados para o usuário logado
	 *
	 * @return mixed
	 */
	public function executar(): mixed
	{
		$usuario = Auth::user();
		$objetos = $usuario->possuiUmLocal->possuiNObjetos;
        return $objetos;
	}
}
