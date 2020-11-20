<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('inventories')) {
            Schema::create('inventories', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('code_id')->unsigned();
                $table->foreign('code_id')->references('id')->on('codes')->onDelete('cascade');
                $table->bigInteger('price');
                $table->integer('quantity');
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
        Schema::dropIfExists('inventories');
    }
}
