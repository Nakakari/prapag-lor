<?php

namespace Database\Seeders;

use App\Helpers\PekerjaanHelper;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisMasterPekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = (new PekerjaanHelper)->getPekerjaan();
        $i = 1;
        foreach ($data as $v) {
            $content = [
                'id' => $i++,
                'kode' => $v['val1'],
                'deskripsi' => $v['val2'],
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            DB::table('master_pekerjaans')->insert($content);
        }
    }
}
