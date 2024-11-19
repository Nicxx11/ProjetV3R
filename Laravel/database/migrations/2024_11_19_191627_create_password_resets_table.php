<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasswordResetsTable extends Migration
{
    public function up()
    {
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('Courriel')->index(); // To store the user's email
            $table->string('token'); // The reset token
            $table->timestamp('created_at')->nullable(); // Timestamp when the token was created
        });
    }

    public function down()
    {
        Schema::dropIfExists('password_resets');
    }
}
