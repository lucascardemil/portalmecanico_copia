<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('quotations')) {
            Schema::create('quotations', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->unsigned()->defaut(1);
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->text('client')->nullable();
                $table->text('vehicle')->nullable();
                $table->text('patent')->nullable();
                $table->text('state')->nullable();
                $table->boolean('is_order')->default(false);
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
        Schema::dropIfExists('quotations');
    }
}
