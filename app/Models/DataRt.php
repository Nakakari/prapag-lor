<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataRt extends Model
{
    protected $table = 'data_rts';
    protected $fillable = ['rw_id', 'name'];

    public function getKetuaRtAttribute()
    {
        $rw = DataRw::find($this->rw_id);

        if ($rw) {
            $ketua_rt = KetuaRt::where('rw', $rw->name)->where('rt', $this->name)->first();

            if ($ketua_rt) {
                return $ketua_rt->name;
            }
        }

        return '';
    }

    protected $appends = ['ketua_rt'];

    public function rw()
    {
        return $this->belongsTo(DataRw::class, 'rw_id', 'id');
    }
}
