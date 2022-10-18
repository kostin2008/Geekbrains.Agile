<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PlantAddWateringDays extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plant', function (Blueprint $table) {
            $table->integer('watering_days')->after('photo_big_path');
            $table->date('add_date')->default(date("Y-m-d H:i:s"))->after('name');
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
            $table->dropColumn('watering_days');
            $table->dropColumn('add_date');
        });
    }
}
