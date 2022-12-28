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
        Schema::create('rejets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text("TextRejet")->nullable();
            $table->string("UserName")->nullable();
            $table->string("UserID")->nullable();
            $table->string("MoisNDF")->nullable();
            $table->string("RejectedBy")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rejets');
    }
};
