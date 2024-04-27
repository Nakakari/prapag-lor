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
        Schema::create('penduduks', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('nik', 30);
            $table->string('no_kk', 30);
            $table->string('nama', 255);
            $table->foreignId('id_jenis_kelamin')->references('id')->on('jenis_kelamins');
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir', 255);
            $table->text('alamat');
            $table->foreignId('id_rw')->references('id')->on('data_rws');
            $table->foreignId('id_rt')->references('id')->on('data_rts');
            $table->string('kelurahan', 255);
            $table->foreignId('id_jenis_status_relation')->references('id')->on('jenis_status_relations');
            $table->foreignId('id_jenis_status_marital')->references('id')->on('jenis_status_maritals');
            $table->foreignId('id_jenis_pendidikan')->references('id')->on('jenis_pendidikans');
            $table->foreignId('id_jenis_agama')->references('id')->on('jenis_agamas');
            $table->foreignId('id_master_pekerjaan')->references('id')->on('master_pekerjaans');
            $table->foreignId('id_jenis_golongan_darah')->references('id')->on('jenis_golongan_darahs');
            $table->string('sertifikat_kelahiran')->nullable();
            $table->string('sertifikat_pernikahan')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->boolean('is_penduduk')->nullable();
            $table->foreignId('created_by')->nullable()->references('id')->on('users');
            $table->foreignId('updated_by')->nullable()->references('id')->on('users');
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
        Schema::dropIfExists('penduduks');
    }
};
