<?php

namespace Database\Seeders;

use App\Helpers\JenisKelaminHelper;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisKelaminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => JenisKelaminHelper::LakiLakiText],
            ['name' => JenisKelaminHelper::PerempuanText],
        ];
        foreach ($data as $key => $v) {
            $key++;
            $v = [
                'id' => $key,
                'name' => $v['name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            DB::table('jenis_kelamins')->insert($v);
        }
    }
}
