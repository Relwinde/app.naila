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
        Schema::create('activites', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('consultation_id')->unsigned()->nullable();
            $table->foreign('consultation_id')->references('id')->on('consultations')->onDelete('cascade');
            $table->bigInteger('agent_id')->unsigned();
            $table->bigInteger('examen_id')->unsigned()->nullable();
            $table->foreign('examen_id')->references('id')->on('examens')->onDelete('set null');
            $table->foreign('agent_id')->references('id')->on('agents')->onDelete('cascade');
            $table->string('observations')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activites');
    }
};
