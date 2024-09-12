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
        Schema::create('coordonnees', function (Blueprint $table) {
            $table->id();
            $table->string('NEQ', 10)->nullable();
            $table->string('Courriel_F', 64);
            $table->string('NoCivique', 8); #alphanumérique
            $table->string('Rue', 64); #peut contenir des car spéciaux
            $table->string('Bureau', 8)->nullable(); #alphanumérique
            $table->string('Ville', 64); #si province québec, utiliser une dropdown pour choisir ville.
            $table->string('Province')->default('Québec'); #énumération des provinces.
            $table->string('CodePostal',6); #nombres & lettres seulement
            $table->string('CodeRegionAdministrative', 2); #liste prédéterminée
            $table->string('RegionAdministrative'); #liste prédéterminée, obligatoire juste pour québec.
            $table->string('SiteInternet', 64)->nullable();
            $table->string('TypeTelephone'); #Bureau, Télécopieur ou Cellulaire
            $table->string('Numero', 10); #exactement 10, numérique seulement
            $table->string('Poste', 6)->nullable(); #numérique seulement
            $table->foreign(['NEQ', 'Courriel_F'])->references(['NEQ', 'Courriel'])->on('fournisseurs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coordonnees');
    }
};
