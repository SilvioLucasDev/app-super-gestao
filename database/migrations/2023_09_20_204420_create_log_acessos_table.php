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
        Schema::create('log_acessos', function (Blueprint $table) {
            $table->id();
            $table->string('ip', 50);
            $table->string('metodo', 10);
            $table->string('rota', 200);
            $table->integer('codigo_retorno');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_acessos');
    }
};
