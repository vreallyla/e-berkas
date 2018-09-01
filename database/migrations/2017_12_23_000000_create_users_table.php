<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nip')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('tempat_lahir');
            $table->string('tgl_lahir');
            $table->string('telp')->nullable();
            $table->integer('provinsi')->nullable()->unsigned();
            $table->integer('kota')->nullable()->unsigned();
            $table->integer('kecamatan')->nullable()->unsigned();
            $table->integer('desa')->nullable()->unsigned();
            $table->string('alamat')->nullable();
            $table->string('kodepos')->nullable();
            $table->integer('job_id')->unsigned();
            $table->foreign('job_id')->references('id')->on('tr_data_job_descs');
            $table->integer('posisition_id')->unsigned()->nullable();
            $table->foreign('posisition_id')->references('id')->on('tr_data_posisitions');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
