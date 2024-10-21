<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_nomes_criancas_table.php
public function up()
{
    Schema::create('nomes_criancas', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('venda_id'); // Relacionamento com a tabela 'vendas'
        $table->string('nome_crianca'); // Nome da criança associada à venda
        $table->timestamps();

        // Definir chave estrangeira, ligando com a tabela 'vendas'
        $table->foreign('venda_id')->references('id')->on('vendas')->onDelete('cascade');
    });
}

public function down()
{
    Schema::dropIfExists('nomes_criancas');
}

};
