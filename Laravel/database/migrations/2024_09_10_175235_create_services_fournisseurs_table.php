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
        Schema::create('services_fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->integer('No_Service');
            $table->string('NEQ', 10)->nullable();
            $table->string('Courriel_F', 64);
            $table->foreign('No_Service')->references('id')->on('services');
            $table->foreign(['NEQ', 'Courriel_F'])->references(['NEQ', 'Courriel'])->on('fournisseurs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services_fournisseurs');
    }
};
