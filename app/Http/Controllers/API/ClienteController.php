<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\Cliente\CreateClienteRequest;

use App\Services\ClienteService;

use Exception;

class ClienteController extends Controller
{

    public function __construct(
        protected ClienteService $clienteService,

    ) {}

    public function listCliente()
    {
        try {
            $clientes = $this->clienteService->listCliente();
            return response()->json([
                'error' => false,
                'messages' => ["Lista de Clientes"],
                'data' => $clientes
            ], 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'messages' => [$e->getMessage()],
                'data' => []
            ], 400, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        }
        
    }

    public function createCliente(CreateClienteRequest $request) 
    {
        try {
            $cliente = $this->clienteService->createCliente([
                "nome" => $request["nome"],
                "email" => $request["email"],
                "telefone" => $request["telefone"]
            ]);

            return response()->json([
                'error' => false,
                'messages' => ["Cliente cadastrado com sucesso!"],
                'data' => $cliente
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
