<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_xx_xx_create_produto_venda_table.php
public function up()
{
    Schema::create('produto_venda', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('venda_id');
        $table->unsignedBigInteger('produto_id');
        $table->integer('quantidade');  // Quantidade de cada produto na venda
        $table->decimal('preco_unitario', 10, 2);  // Preço do produto no momento da venda

        $table->timestamps();

        // Chaves estrangeiras
        $table->foreign('venda_id')->references('id')->on('vendas')->onDelete('cascade');
        $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');
    });
}

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produto_venda');
    }
};
