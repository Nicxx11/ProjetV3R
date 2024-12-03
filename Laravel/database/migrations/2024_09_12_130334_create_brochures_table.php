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
            $table->string('Nom', 32);  // Nom du fichier
            $table->string('NomUnique');
            $table->string('TypeFichier');  // Type de fichier
            $table->integer('Taille');  // Taille du fichier en octets
            $table->date('DateCreation');  // Date de création
            $table->integer('No_Fournisseur');  // ID du fournisseur
            $table->foreign('No_Fournisseur')->references('id')->on('fournisseurs');
            $table->binary('Contenu');  // Contenu du fichier sous forme binaire
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
