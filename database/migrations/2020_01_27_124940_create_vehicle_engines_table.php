<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleEnginesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('vehicle_engines')) {
            Schema::create('vehicle_engines', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('year_id')->references('id')->on('vehicle_years');
                $table->string('v_engine', 90);
                $table->timestamps();
            });

            DB::statement('ALTER TABLE `vehicle_engines` ADD INDEX `year_id_index`(`year_id`) USING BTREE;');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_engines');
    }
}
