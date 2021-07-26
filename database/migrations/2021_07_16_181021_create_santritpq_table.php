<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSantritpqTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('santritpq', function (Blueprint $table) {
            $table->increments('id_santri_tpq');
            $table->string('nisn', 10)->nullable();
            $table->string('nama', 100)->nullable();
            $table->string('tmp_lahir', 20)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('jenis_kelamin');
            $table->string('jenjang');
            $table->text('alamat')->nullable();
            $table->string('nama_ayah', 100)->nullable();
            $table->integer('pekerjaan_ayah')->unsigned();
            $table->string('photo_ayah')->nullable();
            $table->string('nama_ibu', 100)->nullable();
            $table->integer('pekerjaan_ibu')->unsigned();
            $table->string('photo_ibu')->nullable();
            $table->string('hp_wa', 20)->nullable();
            $table->string('photo_santri')->nullable();
            $table->enum('status', array('A', 'P', 'M'))->default('A')->nullable();
            $table->integer('tahun_akademik')->unsigned();
            $table->timestamps();
        });
        Schema::table('santritpq', function (Blueprint $table) {
            $table->foreign('pekerjaan_ayah')
                ->references('id_pekerjaan')
                ->on('pekerjaan')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('santritpq', function (Blueprint $table) {
            $table->foreign('pekerjaan_ibu')
                ->references('id_pekerjaan')
                ->on('pekerjaan')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('santritpq');
        Schema::table('santritpq', function (Blueprint $table) {
            $table->dropForeign('santritpq_pekerjaan_ayah_foreign');
        });
        Schema::table('santritpq', function (Blueprint $table) {
            $table->dropForeign('santritpq_pekerjaan_ibu_foreign');
        });
    }
}
