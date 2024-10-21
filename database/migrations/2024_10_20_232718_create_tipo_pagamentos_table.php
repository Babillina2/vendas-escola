<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_tipo_pagamentos_table.php
    public function up()
    {
        Schema::create('tipo_pagamentos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo'); // Exemplo: 'pix', 'cartao_credito', etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_pagamentos');
    }
};
