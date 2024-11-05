<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Http\Requests\Categoria\CreateCategoriaRequest;

use App\Services\CategoriaService;

use Exception;


class CategoriaController extends Controller
{
    public function  __construct(
        protected CategoriaService $categoriaService

    ){}
        
    public function createCategoria(CreateCategoriaRequest $request){
        try {
            
            $categoria = $this->categoriaService->createCategoria([
                "nome" => $request["nome"],
                "descricao" => $request["descricao"]
            ]);
            return response()->json([
                'error' => false,
                'messages' => ["Categoria Cadastrada com sucesso!"],
                'data' => $categoria
            ], 201, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'messages' => [$e->getMessage()],
                'data' => []
            ], 400, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        }
    }
    
}
