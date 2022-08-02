<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->string('start');
            $table->string('end')->nullable();
            $table->string('description')->nullable();
            $table->string('title');
            $table->string('ville');
            $table->string('code_postal');
            $table->float('peage')->nullable();
            $table->float('parking')->nullable();
            $table->float('essence')->nullable();
            $table->float('divers')->nullable();
            $table->float('repas')->nullable();
            $table->float('hotel')->nullable();
            $table->float('kilometrage');
            $table->string("mois");
            $table->string("heure_debut")->nullable();
            $table->string("heure_fin")->nullable();
            $table->integer('idUser');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};
