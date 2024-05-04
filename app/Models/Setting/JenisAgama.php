<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisAgama extends Model
{
    use HasFactory;
    protected $table = 'jenis_agamas';

    public function listAgama()
    {
        $agamas = $this->all();
        $datas = [];
        foreach ($agamas as $agama) {
            array_push(
                $datas,
                [
                    'id' => $agama->id,
                    'nama' => $agama->nama
                ]
            );
        }
        return $datas;
    }
}
