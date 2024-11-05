<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\{
    CategoriaController,
    ClienteController,
    PedidoController,
    ProdutoController
};

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/clientes', [ClienteController::class , 'listCliente']);
Route::post('/clientes', [ClienteController::class , 'createCliente']);

Route::get('/produtos', [ProdutoController::class, 'listProduto']);
Route::post('/produtos', [ProdutoController::class, 'createProduto']);

Route::post('/categorias', [CategoriaController::class, 'createCategoria']);

Route::post('/categorias', [CategoriaController::class, 'createCategoria']);

Route::post('/pedidos', [PedidoController::class, 'createPedido']);
