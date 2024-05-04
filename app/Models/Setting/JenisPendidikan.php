<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPendidikan extends Model
{
    use HasFactory;
    protected $table = 'jenis_pendidikans';

    public function listData()
    {
        $all = $this->all();
        $datas = [];
        foreach ($all as $a) {
            array_push(
                $datas,
                [
                    'id' => $a->id,
                    'nama' => $a->nama
                ]
            );
        }
        return $datas;
    }
}
