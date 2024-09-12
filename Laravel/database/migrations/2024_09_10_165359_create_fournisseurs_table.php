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
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->integer('id', 1)->autoIncrement();
            $table->string('NEQ', 10)->nullable()->unique(); #10 chiffres
            $table->string('Courriel', 64);
            $table->string('Entreprise', 64);
            $table->string('MotDePasse'); #majuscule, minuscule, chiffres & car spéciaux. doit être encrypté. 12 char max
            $table->string('Details', 500)->nullable();
            $table->string('No_TPS', 64)->nullable();
            $table->string('No_TVQ', 64)->nullable();
            $table->string('Conditions_Paiement', 4)->nullable(); #liste prédéterminée
            $table->string('Devise', 3)->nullable(); # CAD ou USD
            $table->string('Mode_Communication', 64)->nullable(); #liste prédéterminée
            $table->string('Etat_Demande', 64)->nullable(); # En attente, Accepté, Refusé, À réviser

            
            // Devise VARCHAR(3) CHECK ( Devise IN ('CAD', 'USD') ),
            // Mode_Communication VARCHAR(64) CHECK ( Mode_Communication IN ('Courriel', 'Courrier régulier') ),
            // Etat_Demande VARCHAR(64) CHECK ( Etat_Demande IN ('En attente', 'Acceptées', 'Refusées', 'À Réviser' ) ),
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fournisseurs');
    }
};
