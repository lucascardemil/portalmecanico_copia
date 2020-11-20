<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if( !Schema::hasTable('quotation_users') ) {
            Schema::create('quotation_users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('email');
                $table->string('phone');
                $table->timestamps();
                $table->unique(['email','phone']);
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
        Schema::dropIfExists('quotation_users');
    }
}
