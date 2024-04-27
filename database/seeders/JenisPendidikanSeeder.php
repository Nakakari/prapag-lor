<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisPendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['nama' => 'Tidak Sekolah'],
            ['nama' => 'SD'],
            ['nama' => 'SMP'],
            ['nama' => 'SMA'],
            ['nama' => 'DI/DII/DIII'],
            ['nama' => 'S1'],
            ['nama' => 'S2'],
            ['nama' => 'S3'],
        ];
        foreach ($data as $key => $v) {
            $key++;
            $v = [
                'id' => $key,
                'nama' => $v['nama'],
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            DB::table('jenis_pendidikans')->insert($v);
        }
    }
}
