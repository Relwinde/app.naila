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
        Schema::create('mouvement_caisses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vente_produit_id');
            $table->foreign('vente_produit_id')->references('id')->on('vente_produits')->onDelete('cascade');
            $table->unsignedBigInteger('prestation_id');
            $table->foreign('prestation_id')->references('id')->on('prestations')->onDelete('cascade');
            $table->decimal('solde_before', 14, 2);
            $table->decimal('montant', 14, 2);
            $table->decimal('solde_after', 14, 2);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mouvement_caisses');
    }
};
