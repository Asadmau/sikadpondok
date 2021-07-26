<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regis_kelas', function (Blueprint $table) {
            $table->increments('id_regis_kelas');
            $table->integer('nama')->unsigned();
            $table->integer('kelas')->unsigned()->nullable();
            $table->integer('tahun_akademik')->unsigned()->nullable();
            $table->timestamps();
        });
        Schema::table('regis_kelas', function (Blueprint $table) {
            $table->foreign('nama')->references('id_santri_tpq')->on('santritpq')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('regis_kelas', function (Blueprint $table) {
            $table->foreign('kelas')->references('id_kelas')->on('kelas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regis_kelas');
        Schema::table('regis_kelas', function (Blueprint $table) {
            $table->dropForeign('regis_kelas_nama_foreign');
        });
        Schema::table('regis_kelas', function (Blueprint $table) {
            $table->dropForeign('regis_kelas_kelas_foreign');
        });
    }
}
