<?php

namespace App\Http\Controllers;

use App\Http\Resources\Cadastro_Resource;
use Illuminate\Support\Facades\Auth;

class Local_Controller extends Controller
{
    public function show()
    {
        $local = Auth::user()->possuiUmLocal;
        return new Cadastro_Resource($local);
    }
}
