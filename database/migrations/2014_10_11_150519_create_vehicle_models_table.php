<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( !Schema::hasTable('vehicle_models') ) {
            Schema::create('vehicle_models', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('brand_id')->unsigned();
                $table->foreign('brand_id')->references('id')->on('vehicle_brands')->onDelete('cascade');
                $table->string('model');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_models');
    }
}
