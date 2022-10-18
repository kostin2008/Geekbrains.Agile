<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlant extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plant', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("name");
            $table->string("short_info");
            $table->text("full_info");
            $table->string("photo_small_path");
            $table->string("photo_big_path");
        });
        Schema::create('plant_tag', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger("plant_id");
            $table->string("tag");
            $table->foreign('plant_id')->references('id')->on('plant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plant_tag');
        Schema::dropIfExists('plant');
    }
}
