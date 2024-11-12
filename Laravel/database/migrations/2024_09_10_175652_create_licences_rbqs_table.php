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
        Schema::create('licences_rbqs', function (Blueprint $table) {
            $table->id();
            $table->string('No_Licence_RBQ', 10); #numérique seulement
            $table->string('Statut', 23); # Valide, Valide avec restriction, Non valide
            $table->string('TypeLicence', 26); # Entrepreneur, Contructeur-Propriétaire
            $table->string('Categorie', 10); # Général, Spécialisé
            $table->string('Code_Sous_Categorie', 64); # liste prédéterminée (AnnexeListeSousCategories.pdf)
            $table->string('Travaux_Permis', 255)->nullable(); # liste prédéterminée (AnnexeListeSousCategories.pdf)
            $table->integer('No_Fournisseur');
            $table->foreign('No_Fournisseur')->references('id')->on('fournisseurs');


            // Statut VARCHAR(23) CHECK ( Statut IN ('Valide', 'Valide avec restriction', 'Non valide') ),
            // TypeLicence VARCHAR(26) CHECK ( TypeLicence IN ('Entrepreneur', 'Constructeur-Propriétaire') ),
            // Categorie VARCHAR(10) CHECK ( Categorie IN ('Général', 'Spécialisé') ),
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licences_rbqs');
    }
};
