<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationUserDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('quotation_user_descriptions')) {
            Schema::create('quotation_user_descriptions', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users');
                $table->integer('vehicle_id')->unsigned();
                $table->foreign('vehicle_id')->references('id')->on('quotation_user_vehicles');
                $table->text('email')->references('email')->on('quotation_users')->onDelete('cascade');
                $table->longtext('description');
                $table->boolean('is_completed');
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
        Schema::dropIfExists('quotation_user_descriptions');
    }
}
