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
        Schema::table('escolas', function (Blueprint $table) {
            $table->string('cnpj')->nullable()->change();  // Modifica a coluna 'cnpj' para aceitar nulos
        });
    }
    
    public function down(): void
    {
        Schema::table('escolas', function (Blueprint $table) {
            $table->string('cnpj')->nullable(false)->change();  // Reverte a coluna para não aceitar nulos, se necessário
        });
    }
};
