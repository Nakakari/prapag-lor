<?php

namespace App\Models;

use App\Models\Setting\JenisGolonganDarah;
use App\Models\Setting\JenisKelamin;
use App\Models\Setting\JenisPekerjaan;
use App\Models\Setting\JenisPendidikan;
use App\Models\Setting\JenisStatusMarital;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;
    protected $table = 'penduduks';
    protected $guarded = ['id'];

    const id_jenis_kelamin = 'penduduk.id_jenis_kelamin';
    const id_rt = 'penduduk.id_rt';
    const id_rw = 'penduduk.id_rw';
    const nik = 'penduduk.nik';
    const no_kk = 'penduduk.no_kk';
    const nama = 'penduduk.nama';
    const id_jenis_pendidikan = 'penduduk.id_jenis_pendidikan';
    const id_master_pekerjaan = 'penduduk.id_master_pekerjaan';
    const id_jenis_golongan_darah = 'penduduk.id_jenis_golongan_darah';
    const id_jenis_agama = 'penduduk.id_jenis_agama';

    public function goldar()
    {
        return $this->belongsTo(JenisGolonganDarah::class, 'id_jenis_golongan_darah', 'id');
    }

    public function gender()
    {
        return $this->belongsTo(JenisKelamin::class, 'id_jenis_kelamin', 'id');
    }

    public function statusRelation()
    {
        return $this->belongsTo(JenisStatusMarital::class, 'id_jenis_status_marital', 'id');
    }

    public function rt()
    {
        return $this->belongsTo(DataRt::class, 'id_rt', 'id');
    }

    public function pekerjaan()
    {
        return $this->belongsTo(JenisPekerjaan::class, 'id_master_pekerjaan', 'id');
    }

    public function pendidikan()
    {
        return $this->belongsTo(JenisPendidikan::class, 'id_jenis_pendidikan', 'id');
    }
}
