<?php

namespace App\Http\Controllers;

use App\Http\Resources\Local_Resource;
use App\Models\Local;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Local_Controller extends Controller
{
    public function show()
    {
        $local = Auth::user()->local;
        return new Local_Resource($local[0]);
    }
}
