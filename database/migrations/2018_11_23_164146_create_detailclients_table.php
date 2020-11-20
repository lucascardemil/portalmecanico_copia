<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailclientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('detailclients')) {
            Schema::create('detailclients', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('quotationclient_id')->unsigned();
                $table->foreign('quotationclient_id')->references('id')->on('quotationclients')->onDelete('cascade');
                $table->text('product');
                $table->text('detail')->nullable();
                $table->unsignedInteger('price')->default('0');
                $table->unsignedInteger('quantity')->default('1');
                $table->unsignedInteger('percentage')->default('35');
                $table->unsignedInteger('aditional')->default('0');
                $table->unsignedInteger('transport')->default('0');
                $table->unsignedInteger('utility')->default('0');
                $table->unsignedInteger('total')->default('0');
                $table->text('days')->nullable();
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
        Schema::dropIfExists('detailclients');
    }
}
