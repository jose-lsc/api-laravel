<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\PedidoProduto;
use App\Models\Produto;
use Exception;

use Illuminate\Database\Eloquent\Collection;

class PedidoService {
   
    public function createPedido(array $dto): Pedido | Exception{
        try {
            DB::beginTransaction();
                $pedido = Pedido::create([
                    'cliente_id' => $dto['cliente_id'],
                    'pedido_pago' => $dto['pedido_pago']
                ]);

                foreach ($dto["produtos"] as $prod)
                {
                    $produto = (new Produto)->where("id", $prod['produto_id'])->firstOrFail();

                    PedidoProduto::updateOrCreate([
                        'pedido_id' => $pedido->id,
                        'produto_id' => $prod['produto_id'],
                    ],[
                        'pedido_id' => $pedido->id,
                        'produto_id' => $prod['produto_id'],
                        'quantidade' => $prod['quantidade'],
                        'valor_unidade' => $produto->preco,
                        'valor_total' => ($produto->preco * $prod['quantidade'])
                    ]);
                }
            DB::commit();
            return $pedido;
        } catch (Exception $e) {
            DB::rollBack();
            return throw new Exception($e->getMessage());
        }
    }

}