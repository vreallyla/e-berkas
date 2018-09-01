<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrDataHistorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_data_historis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('file');
            $table->string('desc');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('data_id')->unsigned();
            $table->foreign('data_id')->references('id')->on('mst_datas');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('tr_data_categories');
            $table->integer('job_id')->unsigned();
            $table->foreign('job_id')->references('id')->on('tr_data_job_descs');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr_data_historis');
    }
}
