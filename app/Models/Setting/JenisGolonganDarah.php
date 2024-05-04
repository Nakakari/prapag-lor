<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisGolonganDarah extends Model
{
    use HasFactory;
    protected $table = 'jenis_golongan_darahs';

    public function listDarah()
    {
        $golDars = $this->all();
        $datas = [];
        foreach ($golDars as $golDar) {
            array_push(
                $datas,
                [
                    'id' => $golDar->id,
                    'nama' => $golDar->nama
                ]
            );
        }
        return $datas;
    }
}
