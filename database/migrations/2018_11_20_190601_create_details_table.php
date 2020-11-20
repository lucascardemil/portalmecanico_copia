<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('details')) {
            Schema::create('details', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('quotation_id')->unsigned();
                $table->foreign('quotation_id')->references('id')->on('quotations')->onDelete('cascade');
                $table->text('product')->nullable();
                $table->unsignedInteger('price')->default(0);
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
        Schema::dropIfExists('details');
    }
}
