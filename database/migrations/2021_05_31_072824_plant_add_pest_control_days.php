<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PlantAddPestControlDays extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plant', function (Blueprint $table) {
            $table->integer('pest_control_days')->after('manuring_days');
            
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
            $table->dropColumn('pest_control_days');
            
        });
    }
}
