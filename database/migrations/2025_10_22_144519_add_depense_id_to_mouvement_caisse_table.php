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
        Schema::table('mouvement_caisses', function (Blueprint $table) {
            $table->unsignedBigInteger('depense_id')->nullable()->after('activite_id');
            $table->foreign('depense_id')->references('id')->on('depenses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mouvement_caisses', function (Blueprint $table) {
            $table->dropForeign(['depense_id']);
            $table->dropColumn('depense_id');
        });
    }
};
