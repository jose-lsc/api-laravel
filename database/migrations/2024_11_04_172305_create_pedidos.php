<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cliente_id')->unsigned()->nullable(false);
            $table->foreign('cliente_id')
                ->references('id')
                ->on('clientes');
            $table->boolean('pedido_pago')->default(false);
            $table->timestamps($precision = 0);
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
