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
        Schema::create('services_fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->integer('No_Service');
            $table->integer('No_Fournisseur_NEQ')->length(10);
            $table->string('No_Fournisseur_Courriel', 64);
            $table->foreign('No_Service')->references('id')->on('services');
            $table->foreign(['No_Fournisseur_NEQ', 'No_Fournisseur_Courriel'])->references(['NEQ', 'Courriel'])->on('fournisseurs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services_fournisseurs');
    }
};
