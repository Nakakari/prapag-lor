<?php

namespace Database\Seeders;

use App\Models\DataRt;
use App\Models\DataRw;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RtRwSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DataRw::truncate();
        // DataRt::truncate();

        $data_rws = [1, 2, 3];
        $data_rts = [1, 2, 3, 4, 5, 6, 7, 8];

        foreach ($data_rws as $row) {
            $rw = DataRw::create([
                'name' => $row
            ]);

            foreach ($data_rts as $rt) {
                if ($rt == 8 and $row == 2) {
                } else {
                    DataRt::create([
                        'rw_id' => $rw->id,
                        'name' => $rt
                    ]);
                }
            }
        }
    }
}
