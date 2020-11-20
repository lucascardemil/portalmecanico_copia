<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('activities')) {
            Schema::create('activities', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('client_id')->unsigned();
                $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
                $table->text('name');
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
        Schema::dropIfExists('activities');
    }
}
