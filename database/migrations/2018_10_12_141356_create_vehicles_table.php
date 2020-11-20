<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( !Schema::hasTable('vehicles') ){
            Schema::create('vehicles', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->text('patent');
                $table->text('chasis');
                $table->text('name');
                $table->integer('year')->nullable();
                $table->text('engine');
                $table->text('color')->nullable();
                $table->text('km')->nullable();
                $table->text('mechanic')->nullable();
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
        Schema::dropIfExists('vehicles');
    }
}
