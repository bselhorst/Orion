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
        Schema::create('projeto_orcamento_despesas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_orcamento');
            $table->foreign('id_orcamento')->references('id')->on('projeto_orcamentos')->onDelete('cascade');
            $table->string('descricao');
            $table->string('unidade')->nullable();
            $table->bigInteger('quantidade')->nullable();
            $table->decimal('valor_unitario', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projeto_orcamento_despesas');
    }
};
