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
            $table->datetime('Date_Modification')->nullable(); # date & heure
            $table->string('Modification'); #ce qui a été modifié pas la valeur de la modif
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
