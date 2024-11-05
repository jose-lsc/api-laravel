<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $fillable = [
        'cliente_id',
        'pedido_pago',

    ];
    public function cliente(){
        return $this->belongsTo(Cliente::class,'cliente_id', 'id');
    }
    
    public function pedidosProdutos(){
        return $this->hasMany(PedidoProduto::class, 'pedido_id','id');
    }
}
