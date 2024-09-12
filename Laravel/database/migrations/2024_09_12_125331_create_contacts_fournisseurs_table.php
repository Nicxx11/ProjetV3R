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
        Schema::create('contacts_fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->string('NEQ', 10)->nullable();
            $table->string('Courriel_F', 64);
            $table->string('Prenom', 32); #lettres et , -
            $table->string('Nom', 32); #lettres et , -
            $table->string('Fonction', 32); #lettres et car spéciaux
            $table->string('Courriel', 64);
            $table->string('TypeTelephone'); #Bureau, Télécopieur, Cellulaire
            $table->string('Numero', 10); #numerique seulement
            $table->string('Poste', 6); #numerique seulement
            $table->foreign(['NEQ', 'Courriel_F'])->references(['NEQ', 'Courriel'])->on('fournisseurs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_fournisseur');
    }
};
