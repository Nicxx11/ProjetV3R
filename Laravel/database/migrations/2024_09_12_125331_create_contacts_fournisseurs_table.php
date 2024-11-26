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
            $table->string('Prenom', 32); #lettres et , -
            $table->string('Nom', 32); #lettres et , -
            $table->string('Fonction', 32); #lettres et car spéciaux
            $table->string('Courriel', 64);
            $table->string('TypeTelephone'); #Bureau, Télécopieur, Cellulaire
            $table->string('Numero', 10); #numerique seulement
            $table->string('Poste', 6)->nullable(); #numerique seulement
            $table->integer('No_Fournisseur');
            $table->foreign('No_Fournisseur')->references('id')->on('fournisseurs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts_fournisseurs');
    }
};
