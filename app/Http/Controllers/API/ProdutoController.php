<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Produto\CreateProdutoRequest;
use App\Services\ProdutoService;
use Exception;

class ProdutoController extends Controller
{
    public function __construct( 
        protected ProdutoService $produtoService

    ){}

    public function createProduto(CreateProdutoRequest $request){
        try {
            $produto = $this->produtoService->createProduto([
                'nome' => $request['nome'],
                'preco' => $request['preco'],
                'quantidade_estoque' => $request['quantidade_estoque'],
                'marca' => $request['marca'],
                'descricao' => $request['descricao'],
                'categoria_ids' => $request['categoria_ids']
            ]);
            return response()->json([
                "error" => false,
                "message" => "Produto Cadastrado com Sucesso",
                "data" => $produto
            ], 201, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return response()->json([
                "error" => true,
                "message" => [$e->getMessage()],
                "data" => []
            ], 400, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        }
    }

    public function listProduto(Request $request){
        try {
            $produto = $this->produtoService->listProdutosFiltro(
                $request['produtoNome'],
                $request['categoria'],
                $request['marca'],
                $request['precoMin'],
                $request['precoMax'],
            );
            return response()->json([
                "error" => false,
                "message" => ["Lista de produtos"],
                "data" => $produto
            ], 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return response()->json([
                "error" => true,
                "message" => [$e->getMessage()],
                "data" => []
            ], 400, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        }
        
        
    }
}
