<?php

namespace App\Http\Controllers;

use App\Exports\MonografiPendudukExport;
use App\Exports\RegisterPendudukExport;
use App\Helpers\AplikasiHelper;
use App\Helpers\ClassMonografiPendudukHelper;
use App\Helpers\FilterMonografiPendudukHelper;
use App\Helpers\GetDataMonografiHelper;
use App\Helpers\JenisKelaminHelper;
use App\Models\DataRt;
use App\Models\DataRw;
use App\Models\Penduduk;
use App\Models\Setting\{
    JenisAgama,
    JenisGolonganDarah,
    JenisKelamin,
    JenisPekerjaan,
    JenisPendidikan,
    JenisStatusMarital,
    JenisStatusRelation
};
use App\Services\PendudukService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Throwable;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Maatwebsite\Excel\Facades\Excel;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf;


class PendudukController extends Controller
{
    public function index(Request $request)
    {
        $data = $this->queryPenduduk($request);

        // dd($data->where('id_jenis_kelamin', JenisKelaminHelper::Perempuan));
        $laki = $data->where(Penduduk::id_jenis_kelamin, JenisKelaminHelper::LakiLaki)->count();
        $perempuan = $data->where(Penduduk::id_jenis_kelamin, JenisKelaminHelper::Perempuan)->count();
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
        $statusKawin = JenisStatusMarital::all();
        $statusRelation = JenisStatusRelation::all();
        $dataRwRt =  DataRw::with('rts')->get();

        return view('penduduk.form', compact([
            'data',
            'jenisAgama',
            'rw',
            'jenisKelamin',
            'jenisPekerjaan',
            'jenisPendidikan',
            'jenisGolDar',
            'statusKawin',
            'statusRelation',
            'dataRwRt',
        ]));
    }

    public function store(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $form = array_merge($request->all(), [
                    'uuid' => Uuid::uuid4()->toString(),
                    'created_by' => Auth::user()->id,
                    'kelurahan' => AplikasiHelper::desa,
                    'is_penduduk' => true,
                ]);
                $check_nik = Penduduk::where('nik', $request->nik)
                    ->first();

                if ($check_nik) {
                    return redirect()->back()->with('error-message', 'Data Sudah ada, NIK Sudah Digunakan');
                }
                $data = Penduduk::create($form);
            });
            return redirect()->route('penduduk.index')->with('success-message', 'Berhasil Tambah Data');
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error-message', $e->getMessage());
        }
    }

    public function edit(string $uuid)
    {
        $data = Penduduk::where('uuid', $uuid)->firstOrFail();
        $jenisAgama = JenisAgama::all();
        $rw = DataRw::all();
        $jenisKelamin = JenisKelamin::all();
        $jenisPekerjaan = JenisPekerjaan::all();
        $jenisPendidikan = JenisPendidikan::all();
        $jenisGolDar = JenisGolonganDarah::all();
        $statusKawin = JenisStatusMarital::all();
        $statusRelation = JenisStatusRelation::all();
        $dataRwRt =  DataRw::with('rts')->get();

        return view('penduduk.form', compact(
            'data',
            'jenisAgama',
            'rw',
            'jenisKelamin',
            'jenisPekerjaan',
            'jenisPendidikan',
            'jenisGolDar',
            'statusKawin',
            'statusRelation',
            'dataRwRt',
        ));
    }

    public function show($id)
    {
        $data = Penduduk::findOrFail($id);
        return view('penduduk.show', compact(['data']));
    }

    public function update(string $uuid, Request $request)
    {
        try {
            $data = Penduduk::where('uuid', $uuid)->firstOrFail();
            $form = array_merge($request->all(), [
                'updated_by' => Auth::user()->id,
            ]);
            $data->update($form);
            return redirect()->route('penduduk.index')->with('success-message', 'Berhasil Ubah Data');
        } catch (Throwable $e) {
            return redirect()->back()->with('error-message', $e->getMessage());
        }
    }

    public function destroy($id, PendudukService $pendudukService)
    {
        $isDelete = $pendudukService->delete($id);
        $status = $isDelete == 200 ? 'success-message' : 'error-message';
        $message = $isDelete == 200 ? 'Berhasil Hapus Data.' : 'Gagal Menghapus Data.';
        return redirect()->route('penduduk.index')->with($status, $message);
    }

    public function rekap()
    {
        $rw = DB::select('SELECT DISTINCT(rw) FROM ketua_rts');
        $data = [];
        foreach ($rw as $row) {
            $data[$row->rw] = DB::select("SELECT DISTINCT(k.rt), 
                            (SELECT 
                            COUNT(id) 
                            FROM penduduks
                            WHERE TRIM(LEADING '0' FROM rt) = k.rt AND TRIM(LEADING '0' FROM rw) = " . $row->rw . ") AS jumlah_penduduk,
                            
                            (SELECT 
                            COUNT(id) 
                            FROM penduduks
                            WHERE TRIM(LEADING '0' FROM rt) = k.rt AND TRIM(LEADING '0' FROM rw) = " . $row->rw . " AND gender ='L') AS jumlah_l,
                            
                            (SELECT 
                            COUNT(id) 
                            FROM penduduks
                            WHERE TRIM(LEADING '0' FROM rt) = k.rt AND TRIM(LEADING '0' FROM rw) = " . $row->rw . " AND gender ='P') AS jumlah_p
                            
                            
                            FROM ketua_rts k");
        }


        return view('penduduk.rekap', compact('data'));
    }

    public function dataMonografi(Request $request)
    {
        $dataMonografi = GetDataMonografiHelper::parsingData($request->rt, $request->rw, $request->filter_kondisi);
        // dd($dataMonografi);
        return view($dataMonografi['view'], $dataMonografi);
    }

    public function exportMonografi(Request $request, PendudukService $pendudukService)
    {
        $namaFile = $pendudukService->namaMonografi($request->query('kondisi'));
        if ($request->query('btnType') == 'btnExcel') {
            $name = $namaFile . '.xlsx';
            $type = \Maatwebsite\Excel\Excel::XLSX;
            return Excel::download(
                new MonografiPendudukExport(
                    $request->query('rt'),
                    $request->query('rw'),
                    $request->query('kondisi'),
                ),
                $name,
                $type
            );
        } else {
            $name = $namaFile . '.pdf';
            $type = \Maatwebsite\Excel\Excel::MPDF;
            $dataMonografi = GetDataMonografiHelper::parsingData($request->query('rt'), $request->query('rw'), $request->query('kondisi'));
            // dd($dataMonografi);
            $ukuran = $request->query('kondisi') == 'a3';
            $pdf = PDF::loadView($dataMonografi['export'], $dataMonografi['data'])->setPaper($ukuran, 'landscape');
            return $pdf->stream($name);
        }
    }

    public function pendudukExport(Request $request)
    {
        $namaFile = 'Register Penduduk';

        if ($request->query('btnType') == 'btnExcel') {
            $name = $namaFile . '.xlsx';
            $type = \Maatwebsite\Excel\Excel::XLSX;
            // return Excel::download(
            //     new RegisterPendudukExport(
            //         $request->query('nik'),
            //         $request->query('no_kk'),
            //         $request->query('nama'),
            //         $request->query('pendidikan'),
            //         $request->query('umur'),
            //         $request->query('umur2'),
            //         $request->query('pekerjaan'),
            //         $request->query('goldar'),
            //         $request->query('gender'),
            //         $request->query('agama'),
            //         $request->query('rw'),
            //         $request->query('rt'),
            //     ),
            //     $name,
            //     $type
            // );
        } else {
            $name = $namaFile . '.pdf';
            $type = \Maatwebsite\Excel\Excel::MPDF;
            // $data = [
            //     'data' => $this->queryPenduduk($request),
            // ];
            // // dd($data);
            // $pdf = PDF::loadView('penduduk.export.register-penduduk-pdf', $data)->setPaper('A4', 'landscape');
            // return $pdf->stream($name);
        }
        return Excel::download(
            new RegisterPendudukExport(
                $request->query('nik'),
                $request->query('no_kk'),
                $request->query('nama'),
                $request->query('pendidikan'),
                $request->query('umur'),
                $request->query('umur2'),
                $request->query('pekerjaan'),
                $request->query('goldar'),
                $request->query('gender'),
                $request->query('agama'),
                $request->query('rw'),
                $request->query('rt'),
            ),
            $name,
            $type
        );
    }

    public function queryPenduduk($request)
    {
        $data = Penduduk::query();

        if ($request->has('rt') && $request->rt) {
            $data = $data->where(Penduduk::id_rt, $request->rt);
        }

        if ($request->has('rw') && $request->rw) {
            $data = $data->where(Penduduk::id_rw, $request->rw);
        }

        if ($request->has('nik') && $request->nik != null) {
            $data = $data->where(Penduduk::nik, '=', $request->nik);
        }
        if ($request->has('no_kk') && $request->no_kk != null) {
            $data = $data->where(Penduduk::no_kk, '=', $request->no_kk);
        }
        if ($request->has('nama') && $request->nama != null) {
            $data = $data->where(Penduduk::nama, '=', $request->nama);
        }

        if ($request->has('pendidikan') && $request->pendidikan) {
            $data =  $data->where(Penduduk::id_jenis_pendidikan, $request->pendidikan);
        }

        if ($request->has('pekerjaan') && $request->pekerjaan) {
            $data = $data->where(Penduduk::id_master_pekerjaan, $request->pekerjaan);
        }

        if ($request->has('goldar') && $request->goldar != null) {
            $data = $data->where(Penduduk::id_jenis_golongan_darah, $request->goldar);
        }

        if ($request->has('gender') && $request->gender) {
            $data = $data->where(Penduduk::id_jenis_kelamin, $request->gender);
        }

        if ($request->has('agama') && $request->agama) {
            $data = $data->where(Penduduk::id_jenis_agama, $request->agama);
        }

        if ($request->has('umur') && $request->umur != null) {
            $awal = date('Y') - $request->umur;
            $awal = Carbon::create($awal, 1, 1)->addYear()->format('Y-m-d');
            $data = $data->whereRaw('tanggal_lahir < "' . $awal . '"');
        }
        if ($request->has('umur2') && $request->umur2 != null) {
            $akhir = date('Y') - $request->umur2;
            $akhir = Carbon::create($akhir, 1, 1)->format('Y-m-d');
            $data = $data->whereRaw('tanggal_lahir >= "' . $akhir . '"');
        }

        $data->where('is_penduduk', true);

        if (auth()->user()->role == 'ketua_rt' && auth()->user()->ketua_rt) {
            $data = $data->where(Penduduk::id_rt, auth()->user()->ketua_rt->rt);
            $data = $data->where(Penduduk::id_rw, auth()->user()->ketua_rt->rw);
        }

        $data = $data->orderBy('created_at', 'DESC')->get();
        return $data;
    }
}
