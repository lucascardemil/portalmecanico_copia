<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( !Schema::hasTable('images') ){
            Schema::create('images', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('detail_vehicle_id')->unsigned();
                $table->foreign('detail_vehicle_id')->references('id')->on('detail_vehicles')->onDelete('cascade');
                $table->text('url');
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
        Schema::dropIfExists('images');
    }
}
