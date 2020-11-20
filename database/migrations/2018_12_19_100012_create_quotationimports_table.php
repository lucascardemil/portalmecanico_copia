<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationimportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('quotationimports')) {
            Schema::create('quotationimports', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('import_id')->unsigned();
                $table->foreign('import_id')->references('id')->on('imports')->onDelete('cascade');
                $table->integer('user_id')->unsigned()->defaut(1);
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->integer('client_id')->unsigned();
                $table->foreign('client_id')->references('id')->on('clients');
                $table->text('payment')->nullable();
                $table->text('state')->nullable();
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
        Schema::dropIfExists('quotationimports');
    }
}
