<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleBrandModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('vehicle_brand_models')) {
            Schema::create('vehicle_brand_models', function (Blueprint $table) {  
                $table->increments('id');
                $table->string('brand', 30);
                $table->string('model',30);
                $table->integer('tipo_id')->unsigned();
                $table->foreign('tipo_id')->references('id')->on('vehicle_tipos');
                $table->timestamps();
            });

            DB::statement('ALTER TABLE `vehicle_brand_models` ADD INDEX `v_brand_index`(`brand`) using HASH;');
            DB::statement('ALTER TABLE `vehicle_brand_models` ADD INDEX `v_model_index`(`model`) using HASH;');
        }       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_brand_models');
    }
}
