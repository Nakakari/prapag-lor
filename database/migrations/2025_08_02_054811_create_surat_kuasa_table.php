<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_kuasa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_sumber_dana')->references('id')->on('sumber_dana');
            $table->integer('nomor');
            $table->string('nomor_surat');
            $table->string('nama_pemberi_kuasa');
            $table->string('jabatan_pemberi_kuasa');
            $table->string('nik_pemberi_kuasa');
            $table->string('alamat_pemberi_kuasa');
            $table->string('no_hp_pemberi_kuasa');
            $table->string('nama_penerima_kuasa');
            $table->string('jabatan_penerima_kuasa');
            $table->string('nik_penerima_kuasa');
            $table->string('alamat_penerima_kuasa');
            $table->string('no_hp_penerima_kuasa');
            $table->integer('nominal');
            $table->date('start_date');
            $table->date('end_date');
            $table->date('tanggal');
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
        Schema::dropIfExists('surat_kuasa');
    }
};