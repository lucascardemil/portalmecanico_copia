<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productsales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sale_id')->unsigned();
            $table->foreign('sale_id')->references('id')->on('sales');
            $table->integer('code_id')->unsigned();
            $table->foreign('code_id')->references('id')->on('codes');
            $table->integer('price')->unsigned();
            $table->float('utility');
            $table->smallInteger('quantity')->unsigned();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productsales');
    }
}
