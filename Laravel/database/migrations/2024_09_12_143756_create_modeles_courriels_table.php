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
        Schema::create('modeles_courriels', function (Blueprint $table) {
            $table->integer('id', 1)->autoIncrement();
            $table->string('NomModele', 64);
            $table->string('ObjetModele', 64);
            $table->string('MessageModele');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modeles_courriels');
    }
};
