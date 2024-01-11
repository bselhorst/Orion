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
        Schema::create('projetos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('instituicao_executora')->nullable();
            $table->string('responsavel_ie')->nullable();
            $table->string('instituicao_concedente')->nullable();
            $table->string('responsavel_ic')->nullable();
            $table->text('objeto')->nullable();
            $table->string('meta')->nullable();
            $table->string('gestor')->nullable();
            $table->string('lider')->nullable();
            $table->decimal('valor', 10, 2)->nullable();
            $table->date('data_inicio')->nullable();
            $table->date('data_termino')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projetos');
    }
};
