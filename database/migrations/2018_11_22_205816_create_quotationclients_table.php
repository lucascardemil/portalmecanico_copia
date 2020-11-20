<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationclientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('quotationclients')) {
            Schema::create('quotationclients', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->unsigned()->defaut(1);
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->integer('client_id')->unsigned();
                $table->foreign('client_id')->references('id')->on('clients');
                $table->text('payment')->nullable();
                $table->text('client_text')->nullable();
                $table->text('vehicle')->nullable();
                $table->text('state');
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
        Schema::dropIfExists('quotationclients');
    }
}
