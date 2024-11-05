<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoProduto extends Model
{
    protected $table = 'pedidos_produtos';

    protected $fillable =[
        'pedido_id',
        'produto_id',
        'quantidade',
        'valor_unidade',
        'valor_total'
    ];

    public function produto() {
        return $this->belongsTo(Produto::class, 'produto_id', 'id');
    }

    public function pedido() {
        return $this->belongsTo(Pedido::class, 'pedido_id', 'id');
    }
}
