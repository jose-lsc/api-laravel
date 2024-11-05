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
        Schema::create('categorias_produtos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('produto_id')->unsigned()->nullable(false);
            $table->foreign('produto_id')
                ->references('id')
                ->on('produtos');
            $table->bigInteger('categoria_id')->unsigned()->nullable(false);
            $table->foreign('categoria_id')
                ->references('id')
                ->on('categorias');
            $table->timestamps($precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias_produtos');
    }
};
