<?php

namespace App\Models;

use App\Helpers\JenisKelaminHelper;
use App\Models\Setting\JenisAgama;
use App\Models\Setting\JenisGolonganDarah;
use App\Models\Setting\JenisKelamin;
use App\Models\Setting\JenisPekerjaan;
use App\Models\Setting\JenisPendidikan;
use App\Models\Setting\JenisStatusMarital;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;
    protected $table = 'penduduks';
    protected $guarded = ['id'];

    const id_jenis_kelamin = 'penduduks.id_jenis_kelamin';
    const id_rt = 'penduduks.id_rt';
    const id_rw = 'penduduks.id_rw';
    const nik = 'penduduks.nik';
    const no_kk = 'penduduks.no_kk';
    const nama = 'penduduks.nama';
    const id_jenis_pendidikan = 'penduduks.id_jenis_pendidikan';
    const id_master_pekerjaan = 'penduduks.id_master_pekerjaan';
    const id_jenis_golongan_darah = 'penduduks.id_jenis_golongan_darah';
    const id_jenis_agama = 'penduduks.id_jenis_agama';
    const id_jenis_status_marital = 'penduduks.id_jenis_status_marital';

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

    public static function listForUmur()
    {
        $data = [
            '0-4',
            '5-9',
            '10-14',
            '15-19',
            '20-24',
            '25-29',
            '30-34',
            '35-39',
            '40-44',
            '45-49',
            '50-54',
            '55-59',
            '60-64',
            '65-69',
            '70-74',
            '>=75',
        ];

        return $data;
    }

    public function monografiUmur($getRw, $getRt)
    {
        $listBerdasar = $this->listForUmur();

        $data = [];
        $data['tslaki'] = 0; //baru
        $data['tsperem'] = 0; //baru
        foreach ($listBerdasar as $berdasar) { //baru
            $data[$berdasar]['tslaki'] = 0;
            $data[$berdasar]['tsperem'] = 0;
        }

        foreach ($getRw as $rw) {
            $data['rw'][$rw]['tlaki'] = 0;
            $data['rw'][$rw]['tperem'] = 0;
            $totalRWL[$rw] = [];
            foreach ($getRt as $rt) {
                $data['rw'][$rw]['rt'][$rt]['tlaki'] = 0;
                $data['rw'][$rw]['rt'][$rt]['tperem'] = 0;
                foreach ($listBerdasar as $berdasar) {
                    $penduduk = Penduduk::query()->where('is_penduduk', true)
                        ->where('id_rw', '=', $rw)
                        ->where('id_rt', '=', $rt);
                    if (strpos($berdasar, '-') != false) {
                        $ber = explode('-', $berdasar);

                        $awal = date('Y') - $ber[0];
                        $awal = Carbon::create($awal, 1, 1)->addYear()->format('Y-m-d');
                        $penduduk->whereRaw('tanggal_lahir < "' . $awal . '"');

                        $akhir = date('Y') - $ber[1];
                        $akhir = Carbon::create($akhir, 1, 1)->format('Y-m-d');
                        $penduduk->whereRaw('tanggal_lahir >= "' . $akhir . '"');
                    } else {
                        $ber = str_replace(">=", "", $berdasar);
                        $awal = date('Y') - $ber;
                        $awal = Carbon::create($awal, 1, 1)->addYear()->format('Y-m-d');
                        $penduduk->whereRaw('tanggal_lahir < "' . $awal . '"');
                    }
                    $penduduk = $penduduk->get();

                    $data['rw'][$rw]['rt'][$rt]['L'][$berdasar] = $penduduk->where('id_jenis_kelamin', '=', JenisKelaminHelper::LakiLaki)->count();
                    $data['rw'][$rw]['rt'][$rt]['P'][$berdasar] = $penduduk->where('id_jenis_kelamin', '=', JenisKelaminHelper::Perempuan)->count();

                    $data['rw'][$rw]['rt'][$rt]['tlaki'] += $data['rw'][$rw]['rt'][$rt]['L'][$berdasar];
                    $data['rw'][$rw]['rt'][$rt]['tperem'] += $data['rw'][$rw]['rt'][$rt]['P'][$berdasar];
                    $totalRWL[$rw][$berdasar][$rt]['L'] = $data['rw'][$rw]['rt'][$rt]['L'][$berdasar];
                    $totalRWL[$rw][$berdasar][$rt]['P'] = $data['rw'][$rw]['rt'][$rt]['P'][$berdasar];
                }
                $data['rw'][$rw]['tlaki'] += $data['rw'][$rw]['rt'][$rt]['tlaki'];
                $data['rw'][$rw]['tperem'] += $data['rw'][$rw]['rt'][$rt]['tperem'];
            }
            foreach ($listBerdasar as $berdasar) {
                $data['rw'][$rw][$berdasar]['tlaki'] = 0;
                $data['rw'][$rw][$berdasar]['tperem'] = 0;
                foreach ($getRt as $rt) {
                    $data['rw'][$rw][$berdasar]['tlaki'] += $totalRWL[$rw][$berdasar][$rt]['L'];
                    $data['rw'][$rw][$berdasar]['tperem'] += $totalRWL[$rw][$berdasar][$rt]['P'];
                }
                $data[$berdasar]['tslaki'] += $data['rw'][$rw][$berdasar]['tlaki']; //baru
                $data[$berdasar]['tsperem'] += $data['rw'][$rw][$berdasar]['tperem']; //baru
            }
            $data['tslaki'] += $data['rw'][$rw]['tlaki']; //baru
            $data['tsperem'] += $data['rw'][$rw]['tperem']; //baru
        }
        $data['berdasarkan']['list'] = $listBerdasar;
        return $data;
    }

    public function monografiJenisKelamin($getRw, $getRt)
    {
        $penduduk = Penduduk::query()->where('is_penduduk', true)->get();
        $data = [];
        foreach ($getRw as $rw) {
            $data['rw'][$rw]['tlaki'] = 0;
            $data['rw'][$rw]['tperem'] = 0;
            foreach ($getRt as $rt) {
                $data['rw'][$rw]['rt'][$rt]['L'] = $penduduk->where('id_rw', $rw)->where('id_rt', '=', $rt)->where('id_jenis_kelamin', JenisKelaminHelper::LakiLaki);
                $data['rw'][$rw]['rt'][$rt]['P'] = $penduduk->where('id_rw', $rw)->where('id_rt', '=', $rt)->where('id_jenis_kelamin', JenisKelaminHelper::Perempuan);
                $data['rw'][$rw]['tlaki'] += count($data['rw'][$rw]['rt'][$rt]['L']);
                $data['rw'][$rw]['tperem'] += count($data['rw'][$rw]['rt'][$rt]['P']);
            }
        }
        return $data;
    }

    public function monografiAgama($getRw, $getRt, $kondisi)
    {
        $dipakai = [
            '2' => [
                'list' => (new JenisAgama())->listAgama(),
                'column' => Penduduk::id_jenis_agama,
                'judul' => 'Agama'
            ],
            '3' => [
                'list' => (new JenisGolonganDarah())->listDarah(),
                'column' => Penduduk::id_jenis_golongan_darah,
                'judul' => 'Golongan Darah'
            ],
            '5' => [
                'list' => (new JenisStatusMarital())->listData(),
                'column' => Penduduk::id_jenis_status_marital,
                'judul' => 'Status Kawin'
            ],
            '7' => [
                'list' => (new JenisPendidikan())->listData(),
                'column' => Penduduk::id_jenis_pendidikan,
                'judul' => 'Jenis Pendidikan'
            ],
        ];
        $listBerdasar = $dipakai[$kondisi]['list'];
        $column = $dipakai[$kondisi]['column'];

        $data = [];
        $data['tslaki'] = 0; //baru
        $data['tsperem'] = 0; //baru
        foreach ($listBerdasar as $berdasar) { //baru
            // dd($berdasar);
            $data[$berdasar['nama']]['tslaki'] = 0;
            $data[$berdasar['nama']]['tsperem'] = 0;
        }

        foreach ($getRw as $rw) {
            $data['rw'][$rw]['tlaki'] = 0;
            $data['rw'][$rw]['tperem'] = 0;
            $totalRWL[$rw] = [];
            foreach ($getRt as $rt) {
                $data['rw'][$rw]['rt'][$rt]['tlaki'] = 0;
                $data['rw'][$rw]['rt'][$rt]['tperem'] = 0;
                foreach ($listBerdasar as $berdasar) {
                    $up = strtoupper($berdasar['nama']);
                    $data['rw'][$rw]['rt'][$rt]['L'][$berdasar['nama']] = Penduduk::query()->where('is_penduduk', true)
                        ->where(function ($query) use ($column, $berdasar, $up) {
                            $query->where($column, $berdasar['id'])
                                ->orWhere($column, $up);
                        })
                        ->where('id_rw',  $rw)
                        ->where('id_rt',  $rt)
                        ->where('id_jenis_kelamin', JenisKelaminHelper::LakiLaki)->get();
                    $data['rw'][$rw]['rt'][$rt]['P'][$berdasar['nama']] = Penduduk::query()->where('is_penduduk', true)
                        ->where(function ($query) use ($column, $berdasar, $up) {
                            $query->where($column, $berdasar['id'])
                                ->orWhere($column, $up);
                        })
                        ->where('id_rw',  $rw)
                        ->where('id_rt',  $rt)
                        ->where('id_jenis_kelamin', JenisKelaminHelper::Perempuan)->get();

                    $data['rw'][$rw]['rt'][$rt]['tlaki'] += count($data['rw'][$rw]['rt'][$rt]['L'][$berdasar['nama']]);
                    $data['rw'][$rw]['rt'][$rt]['tperem'] += count($data['rw'][$rw]['rt'][$rt]['P'][$berdasar['nama']]);
                    $totalRWL[$rw][$berdasar['nama']][$rt]['L'] = count($data['rw'][$rw]['rt'][$rt]['L'][$berdasar['nama']]);
                    $totalRWL[$rw][$berdasar['nama']][$rt]['P'] = count($data['rw'][$rw]['rt'][$rt]['P'][$berdasar['nama']]);
                }
                $data['rw'][$rw]['tlaki'] += $data['rw'][$rw]['rt'][$rt]['tlaki'];
                $data['rw'][$rw]['tperem'] += $data['rw'][$rw]['rt'][$rt]['tperem'];
            }
            foreach ($listBerdasar as $berdasar) {
                $data['rw'][$rw][$berdasar['nama']]['tlaki'] = 0;
                $data['rw'][$rw][$berdasar['nama']]['tperem'] = 0;
                foreach ($getRt as $rt) {
                    $data['rw'][$rw][$berdasar['nama']]['tlaki'] += $totalRWL[$rw][$berdasar['nama']][$rt]['L'];
                    $data['rw'][$rw][$berdasar['nama']]['tperem'] += $totalRWL[$rw][$berdasar['nama']][$rt]['P'];
                }
                $data[$berdasar['nama']]['tslaki'] += $data['rw'][$rw][$berdasar['nama']]['tlaki']; //baru
                $data[$berdasar['nama']]['tsperem'] += $data['rw'][$rw][$berdasar['nama']]['tperem']; //baru
            }
            $data['tslaki'] += $data['rw'][$rw]['tlaki']; //baru
            $data['tsperem'] += $data['rw'][$rw]['tperem']; //baru
        }
        $data['berdasarkan'] = $dipakai[$kondisi];
        // dd($data);
        return $data;
    }

    public function monografiKepala($getRw, $getRt)
    {
        $penduduk = Penduduk::query()
            ->where('is_penduduk', true)
            ->where('id_jenis_status_relation', 'kepala keluarga')
            ->get();
        $data = [];
        foreach ($getRw as $rw) {
            $data['rw'][$rw]['tlaki'] = 0;
            $data['rw'][$rw]['tperem'] = 0;
            foreach ($getRt as $rt) {
                $data['rw'][$rw]['rt'][$rt]['L'] = $penduduk->where('id_rw', $rw)->where('id_rt', $rt)->where('id_jenis_kelamin', JenisKelaminHelper::LakiLaki);
                $data['rw'][$rw]['rt'][$rt]['P'] = $penduduk->where('id_rw', $rw)->where('id_rt',  $rt)->where('id_jenis_kelamin', JenisKelaminHelper::Perempuan);
                $data['rw'][$rw]['tlaki'] += count($data['rw'][$rw]['rt'][$rt]['L']);
                $data['rw'][$rw]['tperem'] += count($data['rw'][$rw]['rt'][$rt]['P']);
            }
        }
        return $data;
    }


    public function monografiPekerjaan($getRw, $getRt)
    {
        $listBerdasar = JenisPekerjaan::get();

        $data = [];

        foreach ($listBerdasar as $berdasar) {
            $pekerjaan = $berdasar->deskripsi;
            foreach ($getRw as $rw) {
                foreach ($getRt as $rt) {
                    $penduduk = Penduduk::query()->where('is_penduduk', true)
                        ->where('id_master_pekerjaan', $berdasar->id)
                        ->where('id_rw', $rw)
                        ->where('id_rt', $rt)
                        ->get();
                    $data['pekerjaan'][$pekerjaan]['rw'][$rw]['rt'][$rt]['L'] = $penduduk->where('id_jenis_kelamin', JenisKelaminHelper::LakiLaki)->count();
                    $data['pekerjaan'][$pekerjaan]['rw'][$rw]['rt'][$rt]['P'] = $penduduk->where('id_jenis_kelamin', JenisKelaminHelper::Perempuan)->count();
                }
            }
        }

        $data['berdasarkan']['list'] = $listBerdasar;
        $data['berdasarkan']['RW'] = $getRw;
        $data['berdasarkan']['RT'] = $getRt;
        return $data;
    }
}
