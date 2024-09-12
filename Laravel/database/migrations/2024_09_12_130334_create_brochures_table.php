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
            $table->string('NEQ', 10)->nullable();
            $table->string('Courriel_F', 64);
            $table->string('Nom', 32); #alphanumérique
            $table->string('TypeFichier'); # tout les documents imprimables possibles
            $table->integer('Taille'); #en octets, somme ne doit pas depasser le maximum autorisé dans la table parametres
            $table->date('DateCreation'); # date
            $table->foreign(['NEQ', 'Courriel_F'])->references(['NEQ', 'Courriel'])->on('fournisseurs');
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
