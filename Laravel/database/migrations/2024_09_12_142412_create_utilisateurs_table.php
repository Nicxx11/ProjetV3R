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
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->integer('id', 1)->autoIncrement();
            $table->string('Prenom', 32); #lettres et , -
            $table->string('Nom', 32); #lettres et , -
            $table->string('Courriel', 64);
            $table->string('Role'); #Administrateur, Responsable, Commis. Minimum 2 admins & 1 responsable at all times.
            $table->string('MotDePasse'); #Maj, Min, Symbole. Doit être encrypté.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateurs');
    }
};
