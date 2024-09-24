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
        Schema::create('services', function (Blueprint $table) {
            $table->integer('id', 1)->autoIncrement();
            $table->string('Nature', 64); # UNSPSC.json - Nature du contrat
            $table->string('Code_Categorie', 5); # UNSPSC.json - Code de catégorie
            $table->string('Categorie', 255); # UNSPSC.json - Description du code UNSPSC
            $table->string('UNSPSC', 8); # UNSPSC.json - Code UNSPSC
            $table->string('Description', 255); # UNSPSC.json - Description détaillée du code UNSPSC
            $table->integer('No_Fournisseur');
            $table->foreign('No_Fournisseur')->references('id')->on('fournisseurs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
