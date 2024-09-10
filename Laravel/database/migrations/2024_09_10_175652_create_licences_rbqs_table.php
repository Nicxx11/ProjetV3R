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
            $table->integer('No_Fournisseur_NEQ')->length(10);
            $table->string('No_Fournisseur_Courriel', 64);
            $table->integer('No_Licence_RBQ')->lenght(10);
            $table->string('Statut', 23);
            $table->string('TypeLicence', 26);
            $table->string('Categorie', 10);
            $table->string('Code_Sous_Categorie', 64);
            $table->string('Travaux_Permis', 64);
            $table->foreign(['No_Fournisseur_NEQ', 'No_Fournisseur_Courriel'])->references(['NEQ','Courriel'])->on('fournisseurs');


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
