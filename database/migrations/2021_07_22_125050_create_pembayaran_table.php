<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->increments('id_pembayaran');
            $table->integer('nama')->unsigned();
            $table->integer('kamar')->unsigned()->nullable();
            $table->integer('spp')->unsigned();
            $table->timestamps();
        });
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->foreign('nama')->references('id_santri')->on('santri')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->foreign('kamar')->references('id_kamar')->on('kamar')->onUpdate('set null')->onDelete('set null');
        });
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->foreign('spp')->references('id_spp')->on('spp_pondok')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran');
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->dropForeign('pembayaran_nama_foreign');
        });
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->dropForeign('pembayaran_kamar_foreign');
        });
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->dropForeign('pembayaran_spp_foreign');
        });
    }
}
