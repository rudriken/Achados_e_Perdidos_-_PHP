<?php

use App\Http\Controllers\Auth_Controller;
use App\Http\Controllers\Cadastro_Controller;
use Illuminate\Http\Request;
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

Route::middleware("auth:sanctum")->get("/user", function (Request $request) {
    return $request->user();
});

Route::group(
    ["prefix" => "auth"],
    function () {
        Route::post("login", [Auth_Controller::class, "login"])->name("auth-login");
        Route::post("refresh", [Auth_Controller::class, "refresh"])->name("auth-refresh");
        Route::post("logout", [Auth_Controller::class, "logout"])->name("auth-logout");
    }
);

Route::post("/locais", [Cadastro_Controller::class, "cadastra"])
    ->name("cadastra");


// Route::get("/locais", [Cadastro_Controller::class, "show"])
//     ->middleware("auth:api")
//     ->name("mostrar.local");

