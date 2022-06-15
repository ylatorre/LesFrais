<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->string('client');
            $table->string('ville');
            $table->string('code_postal');
            $table->float('peages');
            $table->float('parkings');
            $table->float('divers');
            $table->float('repas');
            $table->float('hotels');
            $table->float('kilometrage');
            $table->timestamps();
            $table->foreignId('user_id')->nullable('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('missions');
    }
};
