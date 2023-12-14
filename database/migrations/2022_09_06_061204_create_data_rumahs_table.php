<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_rumahs', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_rumah');
            $table->string('jenis_dinding');
            $table->string('jenis_lantai');
            $table->string('jenis_atap');
            $table->integer('luas');
            $table->string('kepala_keluarga');
            $table->char('jenis_kelamin')->default('l');
            $table->string('rt');
            $table->string('rw');
            $table->string('ketua_rt');
            $table->string('foto_rumah');
            $table->tinyInteger('jamban')->nullable();
            $table->string('air_bersih')->nullable();
            $table->tinyInteger('listrik')->nullable();
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
        Schema::dropIfExists('data_rumahs');
    }
};
