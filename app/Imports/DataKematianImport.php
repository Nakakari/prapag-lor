<?php

namespace App\Imports;

use App\Models\DataKematian;
use Maatwebsite\Excel\Concerns\ToModel;

class DataKematianImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DataKematian([
            //
        ]);
    }
}
