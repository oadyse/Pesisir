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
        Schema::create('fungsi_y', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_parameter');
            $table->integer('fungsi_y');
            $table->timestamps();
            $table->foreign('id_parameter')->references('id')->on('parameter')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fungsi_y');
    }
};
