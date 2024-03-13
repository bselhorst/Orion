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
        Schema::table('projeto_orcamento_despesas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_aux_cept')->nullable()->after('id_orcamento');
            $table->foreign('id_aux_cept')->references('id')->on('aux_cepts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projeto_orcamento_despesas', function (Blueprint $table) {
            $table->dropForeign('projeto_orcamento_despesas_id_aux_cept_foreign');
            $table->dropColumn('id_aux_cept');
        });
    }
};
