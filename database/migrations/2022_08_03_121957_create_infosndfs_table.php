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
        Schema::create('infosndfs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('Utilisateur');
            $table->string('MoisEnCours');
            $table->integer('NombreEvenement');
            $table->boolean('ValidationEnCours')->default(0);
            $table->boolean('Valide')->default(0);
            $table->string('ChevauxFiscaux');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infosndfs');
    }
};
