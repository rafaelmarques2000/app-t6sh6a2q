<?php

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProdutoEstoqueController;
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

Route::resource('produtos', ProdutoController::class)->except(['edit', 'update', 'create', 'destroy']);

Route::prefix('produtos')->group(function () {
    Route::put('{produto}/estoque/entrada', [ProdutoEstoqueController::class, 'adicionarProdutoNoEstoque']);
    Route::put('{produto}/estoque/saida', [ProdutoEstoqueController::class, 'baixarProdutoNoEstoque']);
    Route::get('{produto}/estoque/historico-movimento', [ProdutoEstoqueController::class, 'obterHistoricoDeMovimentoDoProduto']);
});

