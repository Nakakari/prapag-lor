<?php

namespace App\Http\Controllers;

use App\Helpers\ClassMonografiPendudukHelper;
use App\Helpers\JenisKelaminHelper;
use App\Models\DataRt;
use App\Models\DataRw;
use App\Models\Penduduk;
use App\Models\Setting\JenisAgama;
use App\Models\Setting\JenisGolonganDarah;
use App\Models\Setting\JenisKelamin;
use App\Models\Setting\JenisPekerjaan;
use App\Models\Setting\JenisPendidikan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    public function index(Request $request)
    {
        $data = Penduduk::query();

        if ($request->has('rt') && $request->rt) {
            $data->where(Penduduk::id_rt, $request->rt);
        }

        if ($request->has('rw') && $request->rw) {
            $data->where(Penduduk::id_rw, $request->rw);
        }

        if ($request->has('nik') && $request->nik != null) {
            $data->where(Penduduk::nik, '=', $request->nik);
        }
        if ($request->has('no_kk') && $request->no_kk != null) {
            $data->where(Penduduk::no_kk, '=', $request->no_kk);
        }
        if ($request->has('nama') && $request->nama != null) {
            $data->where(Penduduk::nama, '=', $request->nama);
        }

        if ($request->has('pendidikan') && $request->pendidikan) {
            $data->where(Penduduk::id_jenis_pendidikan, $request->pendidikan);
        }

        if ($request->has('pekerjaan') && $request->pekerjaan) {
            $data->where(Penduduk::id_master_pekerjaan, $request->pekerjaan);
        }

        if ($request->has('goldar') && $request->goldar != null) {
            $data->where(Penduduk::id_jenis_golongan_darah, '=', $request->goldar);
        }

        if ($request->has('gender') && $request->gender) {
            $data->where(Penduduk::id_jenis_kelamin, $request->gender);
        }

        if ($request->has('agama') && $request->agama) {
            $data->where(Penduduk::id_jenis_agama, $request->agama);
        }

        if ($request->has('umur') && $request->umur != null) {
            $awal = date('Y') - $request->umur;
            $awal = Carbon::create($awal, 1, 1)->addYear()->format('Y-m-d');
            $data->whereRaw('tanggal_lahir < "' . $awal . '"');
        }
        if ($request->has('umur2') && $request->umur2 != null) {
            $akhir = date('Y') - $request->umur2;
            $akhir = Carbon::create($akhir, 1, 1)->format('Y-m-d');
            $data->whereRaw('tanggal_lahir >= "' . $akhir . '"');
        }

        $data->where('is_penduduk', true);

        if (auth()->user()->role == 'ketua_rt' && auth()->user()->ketua_rt) {
            $data->where(Penduduk::id_rt, auth()->user()->ketua_rt->rt);
            $data->where(Penduduk::id_rw, auth()->user()->ketua_rt->rw);
        }

        $data = $data->orderBy('created_at', 'DESC')->get();

        $laki = $data->where(Penduduk::id_jenis_kelamin, '=', JenisKelaminHelper::LakiLaki)->count();
        $perempuan = $data->where(Penduduk::id_jenis_kelamin, '=', JenisKelaminHelper::Perempuan)->count();
        $total = $laki + $perempuan;
        $penduduk = (new ClassMonografiPendudukHelper())->fieldKondisi();
        $jenisAgama = JenisAgama::all();
        $rw = DataRw::all();
        $jenisKelamin = JenisKelamin::all();
        $jenisPekerjaan = JenisPekerjaan::all();
        $jenisPendidikan = JenisPendidikan::all();
        $jenisGolDar = JenisGolonganDarah::all();

        return view('penduduk.index', compact(
            'data',
            'laki',
            'perempuan',
            'total',
            'penduduk',
            'jenisAgama',
            'rw',
            'jenisKelamin',
            'jenisPekerjaan',
            'jenisPendidikan',
            'jenisGolDar',
        ));
    }

    public function create()
    {
        $data = null;
        $jenisAgama = JenisAgama::all();
        $rw = DataRw::all();
        $jenisKelamin = JenisKelamin::all();
        $jenisPekerjaan = JenisPekerjaan::all();
        $jenisPendidikan = JenisPendidikan::all();
        $jenisGolDar = JenisGolonganDarah::all();

        return view('penduduk.form', compact([
            'data',
            'jenisAgama',
            'rw',
            'jenisKelamin',
            'jenisPekerjaan',
            'jenisPendidikan',
            'jenisGolDar',
        ]));
    }
}
