<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PlantAddManuring extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plant', function (Blueprint $table) {
            $table->integer('manuring_days')->after('watering_days');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plant', function (Blueprint $table) {
            $table->dropColumn('manuring_days');
        });
    }
}
