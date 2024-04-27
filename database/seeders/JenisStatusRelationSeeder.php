<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisStatusRelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['nama' => 'Anak'],
            ['name' => 'Istri'],
            ['name' => 'Kepala Rumah Tangga'],
            ['name' => 'Lainnya'],
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
            DB::table('jenis_status_relations')->insert($v);
        }
    }
}
