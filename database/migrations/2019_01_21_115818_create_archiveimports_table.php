<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchiveimportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('archiveimports')) {
            Schema::create('archiveimports', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('import_id')->unsigned();
                $table->foreign('import_id')->references('id')->on('imports')->onDelete('cascade');
                $table->text('url');
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
        Schema::dropIfExists('archiveimports');
    }
}
