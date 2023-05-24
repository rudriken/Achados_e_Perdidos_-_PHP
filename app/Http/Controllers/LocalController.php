<?php

namespace App\Http\Controllers;

use App\Http\Resources\CadastroResource;
use Illuminate\Support\Facades\Auth;

class LocalController extends Controller
{
    public function show()
    {
        $local = Auth::user()->possuiUmLocal;
        return new CadastroResource($local);
    }
}
