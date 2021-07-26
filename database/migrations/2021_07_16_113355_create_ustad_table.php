<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUstadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ustad', function (Blueprint $table) {
            $table->increments('id_ustad');
            $table->string('nip')->uniqid()->nullable();
            $table->string('nama_lengkap', 100);
            $table->string('tmp_lahir', 100);
            $table->date('tgl_lahir');
            $table->text('alamat_ustad');
            $table->string('jenis_kelamin', 100);
            $table->string('thn_ajaran', 11);
            $table->string('no_hp_ustad')->nullable();
            $table->enum('status', ['A', 'N', 'K', 'M'])->default('A');
            $table->string('profile_img')->nullable();
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
        Schema::dropIfExists('ustad');
    }
}
