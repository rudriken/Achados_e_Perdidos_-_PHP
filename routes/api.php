<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuscaLocaisController;
use App\Http\Controllers\BuscaObjetosController;
use App\Http\Controllers\CadastroController;
use App\Http\Controllers\InformeDonoController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\ObjetoController;
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
        Route::post("login", [AuthController::class, "login"])->name("auth-login");
        Route::post("refresh", [AuthController::class, "refresh"])->name("auth-refresh");
        Route::post("logout", [AuthController::class, "logout"])->name("auth-logout");
    }
);

Route::group(["middleware" => "auth:api"], function () {
    Route::get("/locais", [LocalController::class, "show"])
        ->name("mostrar.local");

    Route::post("/locais/imagem", [CadastroController::class, "cadastraImagem"])
        ->name("cadastrar.imagem.local");

    Route::get("/objetos", [ObjetoController::class, "index"])
        ->name("listar.objetos");

    Route::post("/objetos", [ObjetoController::class, "store"])
        ->name("cadastrar.objeto");

    Route::post("/objetos/{objetoId}/imagem", [ObjetoController::class, "update"])
        ->name("cadastrar.imagem.objeto");

    Route::get("/objetos/{objetoId}", [ObjetoController::class, "show"])
        ->name("exibir.objeto");

    Route::put("/objetos/{objetoId}", [ObjetoController::class, "update"])
        ->name("alterar.objeto");

    Route::delete("/objetos/{objetoId}", [ObjetoController::class, "destroy"])
        ->name("deletar.objeto");

    Route::post("/objetos/{objetoId}/donos", InformeDonoController::class)->name("informar.dono");
});

Route::post("/locais", [CadastroController::class, "cadastrar"])
    ->name("cadastrar.local");
Route::get("/locais/busca", BuscaLocaisController::class)
    ->name("buscar.locais");
Route::get("/locais/{localId}/objetos", BuscaObjetosController::class)
    ->name("buscar.objetos");
