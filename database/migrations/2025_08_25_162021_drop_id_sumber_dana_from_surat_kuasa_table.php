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
        Schema::table('surat_kuasa', function (Blueprint $table) {
            // Hapus foreign key dulu
            $table->dropForeign(['id_sumber_dana']);
            // Lalu hapus kolomnya
            $table->dropColumn('id_sumber_dana');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('surat_kuasa', function (Blueprint $table) {
            $table->foreignId('id_sumber_dana')->references('id')->on('sumber_dana');
        });
    }
};
