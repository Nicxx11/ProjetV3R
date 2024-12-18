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
            $table->binary('Contenu'); // 16 Mo (taille maximale pour un longblob)
        });
        DB::statement('ALTER TABLE brochures MODIFY Contenu LONGBLOB');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brochures');
    }
};
