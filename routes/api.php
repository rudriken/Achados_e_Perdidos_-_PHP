<?php

use App\Http\Controllers\Auth_Controller;
use App\Http\Controllers\Cadastro_Controller;
use App\Http\Controllers\Local_Controller;
use App\Http\Controllers\Objeto_Controller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::middleware("auth:sanctum")->get("/user", function (Request $request) {
    return $request->user();
}); */

Route::group(
    ["prefix" => "auth"],
    function () {
        Route::post("login", [Auth_Controller::class, "login"])->name("auth-login");
        Route::post("refresh", [Auth_Controller::class, "refresh"])->name("auth-refresh");
        Route::post("logout", [Auth_Controller::class, "logout"])->name("auth-logout");
    }
);

Route::post("/locais", [Cadastro_Controller::class, "cadastra"])
    ->name("cadastrar.local");


Route::get("/locais", [Local_Controller::class, "show"])
    ->middleware("auth:api")
    ->name("mostrar.local");

Route::post("/locais/imagem", [Cadastro_Controller::class, "imagem"])
    ->middleware("auth:api")
    ->name("cadastrar.imagem");

Route::get("/objetos", [Objeto_Controller::class, "index"])
    ->middleware("auth:api")
    ->name("listar.objetos");

Route::post("/objetos", [Objeto_Controller::class, "store"])
    ->middleware("auth:api")
    ->name("cadastrar.objeto");

Route::post("/objetos/{objetoId}/imagem", [Objeto_Controller::class, "update"])
    ->middleware("auth:api")
    ->name("cadastrar.imagem.objeto");

Route::get("/objetos/{objetoId}", [Objeto_Controller::class, "show"])
    ->middleware("auth:api")
    ->name("exibir.objeto");

Route::put("/objetos/{objetoId}", [Objeto_Controller::class, "update"])
    ->middleware("auth:api")
    ->name("alterar.objeto");

