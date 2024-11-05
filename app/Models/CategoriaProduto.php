<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaProduto extends Model
{
    protected $table = 'categorias_produtos';

    protected $fillable = [
        'produto_id',
        'categoria_id'
    ];

    public function produto() {
        return $this->belongsTo(Produto::class, 'produto_id', 'id');
    }

    public function categoria() {
        return $this->belongsTo(Categoria::class, 'categoria_id', 'id');
    }
}
