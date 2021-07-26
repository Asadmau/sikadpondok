<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengurusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengurus', function (Blueprint $table) {
            $table->increments('id_pengurus');
            $table->char('nik', 11)->uniqid();
            $table->string('nama_pengurus', 100);
            $table->string('tmp_lahir', 50);
            $table->date('tgl_lahir');
            $table->enum('jk', ['L', 'P'])->default('L');
            $table->text('alamat');
            $table->string('thn_akademik', 4);
            $table->string('foto_pengurus');
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
        Schema::dropIfExists('pengurus');
    }
}
