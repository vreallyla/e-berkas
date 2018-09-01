<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrFileHistorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_file_historis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('datake')->unsigned();
            $table->integer('metode')->unsigned();
            $table->integer('file_id')->unsigned();
            $table->foreign('file_id')->references('id')->on('tr_files');
            $table->integer('data_id')->unsigned();
            $table->foreign('data_id')->references('id')->on('mst_datas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr_file_historis');
    }
}
