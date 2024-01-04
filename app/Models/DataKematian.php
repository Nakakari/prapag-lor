<?php

namespace App\Models;

use App\Models\Setting\JenisKelamin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKematian extends Model
{
    use HasFactory;
    protected $table = 'data_kematians';
    protected $fillable = [
        'tahun', 'nik', 'nama', 'jenis_kelamin_id', 'nama_ayah', 'nama_ibu', 'tempat_tanggal_meninggal',
        'tanggal_pemakaman', 'nama_pelapor', 'nik_pelapor', 'nik_pelapor_2', 'nama_pelapor_2', 'nama_keluarga',
        'tanggal_lahir', 'alamat', 'rt_id', 'rw_id', 'penyebab_kematian', 'keterangan', 'created_by', 'updated_by'
    ];
    protected $dates = ['tanggal_pemakaman', 'tanggal_lahir'];

    public function rt()
    {
        return $this->hasOne(DataRt::class, 'id', 'rt_id');
    }

    public function rw()
    {
        return $this->hasOne(DataRw::class, 'id', 'rw_id');
    }

    public function jenisKelamin()
    {
        return $this->hasOne(JenisKelamin::class, 'id', 'jenis_kelamin_id');
    }

    public static function listPejabat()
    {
        $data = [
            ['jabatan' => 'Kasie Pelayanan', 'name' => 'TOLIB'],
        ];

        return $data;
    }

    public function getAll($request)
    {
        $data = DataKematian::all();
        $data = $request->input('rt')  ? $data->where('rt_id', $request->input('rt')) : $data;
        $data = $request->input('rw')  ? $data->where('rw_id', $request->input('rw')) : $data;
        return $data;
    }

    public static function rome_month($index)
    {
        $data = [
            '01' => 'I',
            '02' => 'II',
            '03' => 'III',
            '04' => 'IV',
            '05' => 'V',
            '06' => 'VI',
            '07' => 'VII',
            '08' => 'VIII',
            '09' => 'IX',
            '10' => 'X',
            '11' => 'XI',
            '12' => 'XII',
        ];

        return isset($data[$index]) ? $data[$index] : 'I';
    }

    public static function indo_date($index)
    {
        $data = [
            '1' => 'Senin',
            '2' => 'Selasa',
            '3' => 'Rabu',
            '4' => 'Kamis',
            '5' => "Jum'at",
            '6' => 'Sabtu',
            '7' => 'Minggu',

        ];

        return isset($data[$index]) ? $data[$index] : 'I';
    }
}
