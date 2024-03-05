<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('urgencia_atendimentos', function (Blueprint $table) {
            $table->id();
            $table->date('periodo_inicio');
            $table->date('periodo_fim');
            $table->foreignId('promotor_designado_id')->references('id')->on('promotores');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('urgencia_atendimentos');
    }
};
