<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailimportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('detailimports')) {
            Schema::create('detailimports', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('import_id')->unsigned();
                $table->foreign('import_id')->references('id')->on('imports')->onDelete('cascade');
                $table->text('product');
                $table->text('detail');
                $table->float('price')->default('0');
                $table->float('price_dolar')->default('0');
                $table->unsignedInteger('quantity')->default('1');
                $table->float('usa')->default('0');
                $table->float('seguro')->default('0');
                $table->float('valorem')->default('0');
                $table->float('aditional')->default('0');
                $table->float('embarque')->default('0');
                $table->float('fee')->default('0');
                $table->float('fleteUsa')->default('0');
                $table->float('bankusa')->default('0');
                $table->float('bankchile')->default('0');
                $table->float('transferencia')->default('0');
                $table->float('otro')->default('0');
                $table->float('aduana1')->default('0');
                $table->float('aduana2')->default('0');
                $table->float('manipuleo')->default('0');
                $table->float('bodega')->default('0');
                $table->float('guia')->default('0');
                $table->float('retiro')->default('0');
                $table->float('fleteChile')->default('0');
                $table->float('percentage')->default('0');
                $table->float('internacional')->default('0');
                $table->float('nacional')->default('0');
                $table->float('costTotal')->default('0');
                $table->float('unitario')->default('0');
                $table->float('valueChile')->default('0');
                $table->float('utility')->default('0');
                $table->float('total')->default('0');
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
        Schema::dropIfExists('detailimports');
    }
}
