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
            $table->dateTime('Date_Changement_Etat')->nullable(); #date & heure
            $table->dateTime('Date_Creation')->nullable(); #date & heure
            $table->datetime('Date_Derniere_Modification')->nullable(); # date & heure
            $table->integer('No_Fournisseur');
            $table->foreign('No_Fournisseur')->references('id')->on('fournisseurs');
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
