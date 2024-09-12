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
        Schema::create('modifications_fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->string('NEQ', 10)->nullable();
            $table->string('Courriel_F', 64);
            $table->dateTime('Date_Changement_Etat')->nullable(); #date & heure
            $table->dateTime('Date_Creation')->nullable(); #date & heure
            $table->datetime('Date_Derniere_Modification')->nullable(); # date & heure
            $table->foreign(['NEQ', 'Courriel_F'])->references(['NEQ', 'Courriel'])->on('fournisseurs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modifications_fournisseurs');
    }
};
