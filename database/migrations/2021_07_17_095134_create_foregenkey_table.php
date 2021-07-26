<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForegenkeyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('santritpq', function (Blueprint $table) {
            $table->foreign('tahun_akademik')->references('id_tahun_akademik')->on('tahun_akademik')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('regis_kelas', function (Blueprint $table) {
            $table->foreign('tahun_akademik')->references('id_tahun_akademik')->on('tahun_akademik')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('santritpq', function (Blueprint $table) {
            $table->dropForeign('santritpq_tahun_akademik_foreign');
        });
        Schema::table('regis_kelas', function (Blueprint $table) {
            $table->dropForeign('regis_kelas_tahun_akademik_foreign');
        });
    }
}
