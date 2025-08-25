<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SumberDanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('surat_kuasa')->delete();
        DB::table('sumber_dana')->delete();

        $data = [
            ['nama' => 'ADD'],
            ['nama' => 'DD'],
            ['nama' => 'PADes'],
            ['nama' => 'BPH'],
            ['nama' => 'Bantuan Kabupaten'],
            ['nama' => 'Bantuan Provinsi'],
            ['nama' => 'SwaMas'],
            ['nama' => 'DLL'],
        ];
        foreach ($data as $key => $v) {
            $key++;
            $v = [
                'id' => $key,
                'nama' => $v['nama'],
                'keterangan' => '-',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            DB::table('sumber_dana')->insert($v);
        }
    }
}
