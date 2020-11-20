<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( !Schema::hasTable('detail_vehicles') ) {
            Schema::create('detail_vehicles', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('vehicle_id')->unsigned();
                $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
                $table->text('km')->nullable();
                $table->text('note')->nullable();
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
        Schema::dropIfExists('detail_vehicles');
    }
}
