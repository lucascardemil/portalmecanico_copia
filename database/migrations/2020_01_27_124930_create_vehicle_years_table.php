<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('vehicle_years')) {
            Schema::create('vehicle_years', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('v_id')->references('id')->on('vehicle_brand_models');
                $table->unsignedSmallInteger('v_year');
                $table->timestamps();
            });

            DB::statement('ALTER TABLE `vehicle_years` ADD INDEX `v_year_index`(`v_year`) USING BTREE;');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_years');
    }
}
