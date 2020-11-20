<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationUserVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('quotation_user_vehicles')) { 
            Schema::create('quotation_user_vehicles', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users');
                $table->string('email')->references('email')->on('quotation_users')->onDelete('cascade');
                $table->string('patentchasis')->unique();
                //$table->text('chasis');
                $table->text('brand');
                $table->text('model');
                $table->integer('year');
                $table->text('engine');
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
        Schema::dropIfExists('quotation_user_vehicles');
    }
}
