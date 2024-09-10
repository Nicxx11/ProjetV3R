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
            $table->integer('NEQ')->lenght(10)->nullable()->unique();
            $table->string('Courriel', 64);
            $table->string('Entreprise', 64);
            $table->string('MotDePasse', 12);
            $table->string('Details', 500)->nullable();
            $table->string('No_TPS', 64)->nullable();
            $table->string('No_TVQ', 64)->nullable();
            $table->string('Conditions_Paiement', 4)->nullable();
            $table->string('Devise', 3)->nullable();
            $table->string('Mode_Communication', 64)->nullable();
            $table->string('Etat_Demande', 64)->nullable();
            $table->date('Date_Changement_Etat')->nullable();
            $table->date('Date_Creation')->nullable();
            $table->date('Date_Derniere_Modification')->nullable();
            $table->primary(['NEQ', 'Courriel']);

            
            // DB::statement("ALTER TABLE fournisseurs ADD CONSTRAINT check_devise_fournisseurs CHECK (Devise IN ('CAD', 'USD'))");
            // DB::statement("ALTER TABLE fournisseurs ADD CONSTRAINT check_mode_communication_fournisseurs CHECK (Mode_Communication IN ('Courriel', 'Courrier régulier'))");
            // DB::statement("ALTER TABLE fournisseurs ADD CONSTRAINT check_etat_demande_fournisseurs CHECK (Etat_Demande IN ('En attente', 'Acceptées', 'Refusées', 'À Réviser'))");
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
