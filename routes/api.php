<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

use App\Http\Controllers\RolController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;

use App\Http\Controllers\UsuarioApiController;
use App\Http\Controllers\PersonaApiController;
use App\Http\Controllers\CategoriaApiController;
use App\Http\Controllers\ProductoApiController;
use App\Http\Controllers\VentaApiController;
use App\Http\Controllers\IngresoApiController;
use App\Http\Controllers\InventarioApiController;
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



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware'=> ['auth']], function(){
    Route::apiResource('usuarios', UsuarioApiController::class);
    Route::apiResource('personas', PersonaApiController::class);
    Route::apiResource('categorias', CategoriaApiController::class);
    Route::apiResource('productos', ProductoApiController::class);
    Route::apiResource('ventas', VentaApiController::class);
    Route::apiResource('ingresos', IngresoApiController::class);
    Route::apiResource('inventarios', InventarioApiController::class);


});
