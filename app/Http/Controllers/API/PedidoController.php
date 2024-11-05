<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Http\Requests\Pedido\CreatePedidoRequest;



use App\Services\PedidoService;

use Exception;

class PedidoController extends Controller
{
    public function __construct(
        protected PedidoService $pedidoService
        
    ){}
    public function createPedido(CreatePedidoRequest $request)
    {
        try {
            $pedido = $this->pedidoService->createPedido([
                'cliente_id' => $request['cliente_id'],
                'pedido_pago' => $request['pedido_pago'],
                'produtos' => $request['produtos']
            ]);
            return response()->json([
                "error" => false,
                "message" => "Pedido cadastrado com Sucesso",
                "data" => $pedido
            ], 201, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return response()->json([
                "error" => true,
                "message" => [$e->getMessage()],
                "data" => []
            ], 400, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        }
    }
   
}
