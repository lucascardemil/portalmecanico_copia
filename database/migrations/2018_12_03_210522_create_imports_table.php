<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('imports')) {
            Schema::create('imports', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->unsigned()->defaut(1);
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->text('name')->nullable();
                $table->float('dolar')->default(0);
                $table->float('embarque')->default(0);
                $table->float('fee')->default(0);
                $table->float('fleteUsa')->default(0);
                $table->float('bankusa')->default(0);
                $table->float('bankchile')->default(0);
                $table->float('transferencia')->default(0);
                $table->float('otro')->default(0);
                $table->float('aduana1')->default('0');
                $table->float('aduana2')->default('0');
                $table->float('manipuleo')->default('0');
                $table->float('bodega')->default('0');
                $table->float('guia')->default('0');
                $table->float('retiro')->default('0');
                $table->float('fleteChile')->default('0');
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
        Schema::dropIfExists('imports');
    }
}
