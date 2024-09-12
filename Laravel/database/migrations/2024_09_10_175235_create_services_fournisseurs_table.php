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
            $table->foreign('No_Service')->references('id')->on('services');
            $table->integer('No_Fournisseur');
            $table->foreign('No_Fournisseur')->references('id')->on('fournisseurs');
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
