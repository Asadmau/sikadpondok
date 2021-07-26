<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisKamarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regis_kamar', function (Blueprint $table) {
            $table->increments('id_regis_kamar');
            $table->integer('nama')->unsigned();
            $table->integer('kamar')->unsigned()->nullable();
            $table->integer('tahun_akademik')->unsigned();
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
        Schema::dropIfExists('regis_kamar');
    }
}
