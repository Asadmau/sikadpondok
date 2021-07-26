<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignkeyPonpesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('regis_kamar', function (Blueprint $table) {
            $table->foreign('kamar')->references('id_kamar')->on('kamar')->onUpdate('set null')->onDelete('set null');
        });
        Schema::table('regis_kamar', function (Blueprint $table) {
            $table->foreign('nama')->references('id_santri')->on('santri')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('regis_kamar', function (Blueprint $table) {
            $table->foreign('tahun_akademik')->references('id_tahun_akademik')->on('tahun_akademik')->onUpdate('restrict')->onDelete('restrict');
        });
        Schema::table('santri', function (Blueprint $table) {
            $table->foreign('tahun_akademik')->references('id_tahun_akademik')->on('tahun_akademik')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('santri', function (Blueprint $table) {
            $table->foreign('pekerjaan_ayah')->references('id_pekerjaan')->on('pekerjaan')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('santri', function (Blueprint $table) {
            $table->foreign('pekerjaan_ibu')->references('id_pekerjaan')->on('pekerjaan')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('regis_kamar', function (Blueprint $table) {
            $table->dropForeign('regis_kamar_kamar_foreign');
        });
        Schema::table('regis_kamar', function (Blueprint $table) {
            $table->dropForeign('regis_kamar_nama_foreign');
        });

        Schema::table('regis_kamar', function (Blueprint $table) {
            $table->dropForeign('regis_kamar_tahun_akademik_foreign');
        });

        Schema::table('santri', function (Blueprint $table) {
            $table->dropForeign('santri_tahun_akademik_foreign');
        });

        Schema::table('santri', function (Blueprint $table) {
            $table->dropForeign('santri_pekerjaan_ayah_foreign');
        });
        Schema::table('santri', function (Blueprint $table) {
            $table->dropForeign('santri_pekerjaan_ibu_foreign');
        });
    }
}
