<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PlantUserDone extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('info');
            $table->timestamps();
        });

        Schema::create('plant_user_done', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("plant_id");
            $table->foreign('plant_id')->references('id')->on('plant');
            $table->date('date');
            $table->unsignedBigInteger('action_id');
            $table->foreign('action_id')->references('id')->on('action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plant_user_done');
        Schema::dropIfExists('action');
    }
}
