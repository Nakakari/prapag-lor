<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DataRw extends Model
{
    protected $table = 'data_rws';
    protected $fillable = ['name'];

    public function rts(): HasMany
    {
        return $this->hasMany(DataRt::class, 'rw_id');
    }

    public function listData()
    {
        $all = $this->all();
        $datas = [];
        foreach ($all as $a) {
            array_push(
                $datas,
                $a->id
            );
        }
        return $datas;
    }
}
