<?php

use App\Http\Controllers\ProdutoController;
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

Route::resource('produtos', ProdutoController::class);

Route::put('produtos/{produto}/estoque/entrada', [ProdutoController::class,'entrarProdutoNoEstoque']);
Route::put('produtos/{produto}/estoque/saida', [ProdutoController::class,'baixarProdutoNoEstoque']);
