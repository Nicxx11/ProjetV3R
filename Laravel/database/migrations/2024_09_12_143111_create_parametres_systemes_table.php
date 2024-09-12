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
        Schema::create('parametres_systemes', function (Blueprint $table) {
            $table->integer('id', 1)->autoIncrement();
            $table->string('Approvisionnement', 64); # courriel de l'approvisionnement
            $table->string('DelaiRevision'); # délai avant la révision des dossiers fournisseurs (mois)
            $table->integer('TailleMaxBrochures'); #taille max en Mo des fichiers joints
            $table->string('Finances', 64); # courriel des finances
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parametres_systemes');
    }
};
