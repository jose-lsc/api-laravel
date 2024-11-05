<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedidos_produtos', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('pedido_id')->unsigned()->nullable(false);
            $table->foreign('pedido_id')
                ->references('id')
                ->on('pedidos');

            $table->bigInteger('produto_id')->unsigned()->nullable(false);
                $table->foreign('produto_id')
                    ->references('id')
                    ->on('produtos');
                    
            $table->integer('quantidade');
            $table->decimal('valor_unidade',9,2);
            $table->decimal('valor_total',9,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos_produtos');
    }
};
