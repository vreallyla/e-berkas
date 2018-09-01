<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHistoriToHistorifile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tr_file_historis', function($table) {
            $table->integer('histori_id')->unsigned();
            $table->foreign('histori_id')->references('id')->on('tr_data_historis');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tr_file_historis', function($table) {
            $table->dropColumn('histori_id');
        });
    }
}
