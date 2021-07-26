<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->increments('id_kelas');
            $table->string('kode_kelas', 10)->unique();
            $table->string('nama', 50)->nullable();
            $table->integer('kapasitas')->nullable();
            $table->string('jenjang');
            $table->integer('wali_kelas')->unsigned();
            $table->timestamps();
        });
        Schema::table('kelas', function (Blueprint $table) {
            $table->foreign('wali_kelas')
                ->references('id_ustad')
                ->on('ustad')
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
        Schema::dropIfExists('kelas');
    }
}
