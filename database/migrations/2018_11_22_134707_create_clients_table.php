<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('clients')) {
            Schema::create('clients', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->text('name')->nullable();
                $table->string('rut')->unique();
                $table->text('razonSocial')->nullable();
                $table->text('email')->nullable();
                $table->text('phone')->nullable();
                $table->text('address')->nullable();
                $table->text('comuna')->nullable();
                $table->text('giro')->nullable();
                $table->text('type')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
