<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrRequestChangeJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_request_change_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('desc');
            $table->integer('changejob_id')->unsigned();
            $table->foreign('changejob_id')->references('id')->on('tr_data_job_descs');
            $table->integer('changeposisition_id')->unsigned();
            $table->foreign('changeposisition_id')->references('id')->on('tr_data_posisitions');
            $table->integer('admin_id')->unsigned()->nullable();
            $table->foreign('admin_id')->references('id')->on('users');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('tr_request_change_jobs');
    }
}
