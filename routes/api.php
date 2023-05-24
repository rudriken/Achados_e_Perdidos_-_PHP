<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CadastroController;
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

Route::post("/locais", [CadastroController::class, "cadastra"])
    ->name("cadastrar.local");


Route::get("/locais", [LocalController::class, "show"])
    ->middleware("auth:api")
    ->name("mostrar.local");

Route::post("/locais/imagem", [CadastroController::class, "imagem"])
    ->middleware("auth:api")
    ->name("cadastrar.imagem");

Route::get("/objetos", [ObjetoController::class, "index"])
    ->middleware("auth:api")
    ->name("listar.objetos");

Route::post("/objetos", [ObjetoController::class, "store"])
    ->middleware("auth:api")
    ->name("cadastrar.objeto");

Route::post("/objetos/{objetoId}/imagem", [ObjetoController::class, "update"])
    ->middleware("auth:api")
    ->name("cadastrar.imagem.objeto");

Route::get("/objetos/{objetoId}", [ObjetoController::class, "show"])
    ->middleware("auth:api")
    ->name("exibir.objeto");

Route::put("/objetos/{objetoId}", [ObjetoController::class, "update"])
    ->middleware("auth:api")
    ->name("alterar.objeto");

Route::delete("/objetos/{objetoId}", [ObjetoController::class, "destroy"])
    ->middleware("auth:api")
    ->name("deletar.objeto");
