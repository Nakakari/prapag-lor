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
        Schema::create('data_kematians', function (Blueprint $table) {
            $table->id();
            $table->string('tahun', 4);
            $table->string('nik', 16);
            $table->string('nama', 255);
            $table->foreignId('jenis_kelamin_id')->references('id')->on('jenis_kelamins');
            $table->string('nama_ayah', 255);
            $table->string('nama_ibu', 255);
            $table->string('tempat_tanggal_meninggal', 255);
            $table->string('nama_pelapor', 255);
            $table->string('nik_pelapor', 16);
            $table->string('nama_pelapor_2', 255);
            $table->string('nik_pelapor_2', 16);
            $table->string('nama_keluarga', 255)->nullable();
            $table->string('penyebab_kematian', 255);
            $table->string('keterangan', 255)->nullable();
            $table->date('tanggal_lahir');
            $table->date('tanggal_pemakaman');
            $table->text('alamat');
            $table->foreignId('rw_id')->references('id')->on('data_rws');
            $table->foreignId('rt_id')->references('id')->on('data_rts');
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
        Schema::dropIfExists('data_kematians');
    }
};
