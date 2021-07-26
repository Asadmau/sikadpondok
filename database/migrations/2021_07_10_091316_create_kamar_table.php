<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKamarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kamar', function (Blueprint $table) {
            $table->increments('id_kamar');
            $table->string('nama', 50);
            $table->integer('kapasitas')->nullable();
            $table->enum('kategori', array('BARU', 'LAMA'));
            $table->integer('ketua_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('kamar', function (Blueprint $table) {
            $table->foreign('ketua_id')->references('id_pengurus')->on('pengurus')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kamar');
        Schema::table('kamar', function (Blueprint $table) {
            $table->dropForeign('kamar_ketua_id_foreign');
        });
    }
}
