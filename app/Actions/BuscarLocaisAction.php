<?php

namespace App\Actions;

use App\Models\Local;
use Illuminate\Database\Eloquent\Collection;

class BuscarLocaisAction
{
    /**
     * Faz uma busca de locais no banco de dados
     *
     * @param string $nome
     * @return array
     */
    public function executar(string $nome): Collection
    {
        $locais = Local::where("nome", "like", "%$nome%")->get();
        return $locais;
    }
}
