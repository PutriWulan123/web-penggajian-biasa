<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggajiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penggajians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pegawai');
            $table->foreign('id_pegawai')->references('id')->on('pegawais')->onDelete('cascade');
            $table->unsignedBigInteger('id_devisi');
            $table->foreign('id_devisi')->references('id')->on('devisis')->onDelete('cascade');
            // $table->string('nama_devisi');
            $table->string('periode');
            $table->integer('uang_makan');
            $table->integer('uang_tp');
            $table->integer('total_potongan');
            $table->integer('gaji_pokok');
            $table->date('tgl_penggajian');
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
        Schema::dropIfExists('penggajians');
    }
    
}
