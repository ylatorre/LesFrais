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
            $table->float('peage')->default('0');
            $table->float('peage2')->default('0');
            $table->float('peage3')->default('0');
            $table->float('peage4')->default('0');
            $table->float('parking')->default('0');
            $table->float('essence')->default('0');
            $table->float('divers')->default('0');
            $table->float('petitDej')->default('0');
            $table->float('dejeuner')->default('0');
            $table->float('diner')->default('0');
            $table->float('hotel')->default('0');
            $table->float('kilometrage')->default('0');
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
