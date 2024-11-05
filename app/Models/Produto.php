<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';

    protected $fillable = [
        'nome',
        'preco',
        'quantidade_estoque',
        'marca',
        'descricao'
    ];

    public function categoriasProdutos() {
        return $this->hasMany(CategoriaProduto::class, 'produto_id', 'id');
    }

    public function pedidosProdutos(){
        return $this->hasMany(PedidoProduto::class, 'produto_id','id');
    }
}
