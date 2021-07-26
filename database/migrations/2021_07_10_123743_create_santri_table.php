<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSantriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('santri', function (Blueprint $table) {
            $table->increments('id_santri');
            $table->char('nis', 11)->uniqid();
            $table->string('nama', 100);
            $table->string('tmp_lahir', 100);
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->enum('jenjang', ['SD', 'SMP', 'SMK']);
            $table->text('alamat');
            $table->integer('tahun_akademik')->unsigned()->nullable();
            $table->string('nama_ayah', 100);
            $table->string('nama_ibu', 100);
            $table->integer('pekerjaan_ayah')->unsigned()->nullable();
            $table->integer('pekerjaan_ibu')->unsigned()->nullable();
            $table->string('foto_santri', 100);
            $table->string('foto_wali', 100);
            $table->char('nope', 13);
            $table->enum('status', array('A', 'P', 'M'));
            $table->enum('kategori', array('BARU', 'LAMA'));
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
        Schema::dropIfExists('santri');
    }
}
