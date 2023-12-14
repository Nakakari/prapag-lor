<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataRumah extends Model
{
    protected $table = 'data_rumahs';
    protected $fillable = ['nomor_rumah','jenis_kelamin','jenis_dinding','jenis_lantai','jenis_atap','luas','kepala_keluarga','rt','rw','ketua_rt','foto_rumah','jamban','air_bersih','listrik'];
    
    public static function JenisDinding()
    {
        return [
            'tembok',
            'semi tembok',
            'pagar bambu',
            'kayu'
        ];
    }

    public static function JenisLantai()
    {
        return [
            'tanah',
            'semen',
            'keramik',
            'marmer'
        ];
    }

    public static function JenisAtap()
    {
        return [
            'beton',
            'genteng',
            'seng',
            'asbes'
        ];
    }

    public static function JenisKelamin()
    {
        return [
            'l',
            'p',
        ];
    }    
}
