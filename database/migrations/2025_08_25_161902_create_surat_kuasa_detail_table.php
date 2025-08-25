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
        Schema::create('surat_kuasa_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_surat_kuasa')->references('id')->on('surat_kuasa');
            $table->foreignId('id_sumber_dana')->references('id')->on('sumber_dana');
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
        Schema::dropIfExists('surat_kuasa_detail');
    }
};
