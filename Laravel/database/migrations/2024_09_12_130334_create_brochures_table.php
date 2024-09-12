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
        Schema::create('brochures', function (Blueprint $table) {
            $table->id();
            $table->string('No_Fournisseur_NEQ', 10)->nullable();
            $table->string('No_Fournisseur_Courriel', 64);
            $table->string('Nom', 32); #alphanumérique
            $table->string('TypeFichier'); # tout les documents imprimables possibles
            $table->integer('Taille'); #en octets, somme ne doit pas depasser le maximum autorisé dans la table parametres
            $table->date('DateCreation'); # date
            $table->foreign(['No_Fournisseur_NEQ', 'No_Fournisseur_Courriel'])->references(['NEQ', 'Courriel'])->on('fournisseurs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brochures');
    }
};
