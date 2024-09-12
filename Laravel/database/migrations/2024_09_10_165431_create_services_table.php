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
        Schema::create('services', function (Blueprint $table) {
            $table->integer('id', 1)->autoIncrement();
            $table->string('Nature', 12); #Énumération (association_categorie_codes_final.pdf)
            $table->string('Code_Categorie', 5); # liste prédéterminée (association_categorie_codes_final.pdf)
            $table->string('Categorie', 255); #Général, Spécialisé (association_categorie_codes_final.pdf)
            $table->string('UNSPSC', 8); #liste prédéterminée, 8 car numériques. (association_categorie_codes_final.pdf)
            $table->string('Description', 255); # liste prédéterminée (association_categorie_codes_final.pdf)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
