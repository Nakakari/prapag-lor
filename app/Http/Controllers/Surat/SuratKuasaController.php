<?php

namespace App\Http\Controllers\Surat;

use App\Exports\SuratKuasaExport;
use App\Helpers\BulanHelper;
use App\Helpers\PegawaiHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuratKuasaRequest;
use App\Models\Surat\SumberDana;
use App\Models\Surat\SuratKeluar;
use App\Models\Surat\SuratKuasa;
use App\Models\Surat\SuratKuasaDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Exception;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class SuratKuasaController extends Controller
{
    public function index(Request $request)
    {
        $data = $this->querySuratKuasa($request);

        return view('surat.surat-kuasa.index', compact('data'));
    }

    public function create()
    {
        $data = null;

        $lastNumber = $this->generateNomor();

        // $nomor = ($lastNumber ?? 0) + 1;
        $nomorSuratKeluar = '/' . (new BulanHelper())->bulanRomawi() . '/' . date('Y');

        $penanggungJawab = (new PegawaiHelper())->listPegawai();
        $sumberDanas = SumberDana::all();
        return view('surat.surat-kuasa.form', compact(['data', 'nomorSuratKeluar', 'penanggungJawab', 'sumberDanas']));
    }

    public function store(SuratKuasaRequest $request)
    {
        DB::beginTransaction();
        try {
            $attr = $request->validated();
            // $nomor = ($this->generateNomor() ?? 0) + 1;
            $nomorSuratKeluar = '/' . (new BulanHelper())->bulanRomawi() . '/' . date('Y');

            $form = array_merge($attr, [
                'tanggal' => date('Y-m-d'),
                // 'nomor' => $nomor,
                'nomor_surat' => $nomorSuratKeluar,
                'created_by' => Auth::id(),
                'nominal' => str_ireplace(".", "", $attr['nominal']),
            ]);
            // dd($form['id_sumber_dana']);
            $suratKuasa = SuratKuasa::create($form);
            if (isset($form['id_sumber_dana'])) {
                foreach ($form['id_sumber_dana'] as $idSumberDana) {
                    SuratKuasaDetail::create([
                        'id_surat_kuasa' => $suratKuasa->id,
                        'id_sumber_dana' => $idSumberDana,
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('surat-kuasa.index')->with('status', 'Berhasil Tambah Data');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('fail', $e->getMessage());
        }
    }

    private function generateNomor()
    {
        $now = Carbon::now();

        return SuratKuasa::whereYear('created_at', $now->year)
            ->whereMonth('created_at', $now->month)
            ->max('nomor');
    }

    public function edit(int $id)
    {
        $data = SuratKuasa::with('suratKuasaDetail')->where('id', $id)->firstOrFail();
        // dd($data);

        $lastNumber = $this->generateNomor();

        $nomor = ($lastNumber ?? 0) + 1;
        $nomorSuratKeluar = str_pad($nomor, 3, '0', STR_PAD_LEFT) . '/' . (new BulanHelper())->bulanRomawi() . '/' . date('Y');

        $penanggungJawab = (new PegawaiHelper())->listPegawai();
        $sumberDanas = SumberDana::all();
        return view('surat.surat-kuasa.form', compact(['data', 'nomorSuratKeluar', 'penanggungJawab', 'sumberDanas']));
    }

    public function update(int $id, SuratKuasaRequest $request)
    {
        DB::beginTransaction();
        try {
            $attr = $request->validated();
            $form = array_merge($attr, [
                'updated_by' => Auth::id(),
                'nominal' => str_ireplace(".", "", $attr['nominal']),
            ]);
            $data = SuratKuasa::where('id', $id)->first();
            $data->update($form);

            SuratKuasaDetail::where('id_surat_kuasa', $id)->delete();
            if (isset($form['id_sumber_dana'])) {
                foreach ($form['id_sumber_dana'] as $idSumberDana) {
                    SuratKuasaDetail::create([
                        'id_surat_kuasa' => $id,
                        'id_sumber_dana' => $idSumberDana,
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('surat-kuasa.index')->with('status', 'Berhasil Update Data');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('fail', $e->getMessage());
        }
    }

    public function cetak(int $id)
    {
        $data = SuratKuasa::where('id', $id)->firstOrFail();
        $data->nomor_surat = $data->nomor . $data->nomor_surat;
        $judul = 'Surat Kuasa';
        // return view('surat.surat-kuasa.cetak', compact(['data', 'judul']));
        $pdf = PDF::loadView('surat.surat-kuasa.cetak', compact(['data', 'judul']))->setPaper('a4', 'portrait');
        $judul .= '.pdf';
        return $pdf->stream($judul);
    }

    public function destroy(int $id)
    {
        try {
            DB::transaction(
                function () use ($id) {
                    $data = SuratKuasa::findOrFail($id);
                    SuratKuasaDetail::where('id_surat_kuasa', $id)->delete();
                    Log::info('Surat Kuasa Detail Deleted');
                    $data->delete();
                    Log::info('Surat Kuasa Deleted');
                }
            );
            return redirect()->route('surat-kuasa.index')->with('status', 'Berhasil Hapus Data');
        } catch (Exception $e) {
            return redirect()->back()->with('fail', $e->getMessage());
        }
    }

    public function export(Request $request)
    {
        $namaFile = 'Surat Kuasa';
        $data = $this->querySuratKuasa($request);
        if ($data->count()) {
            if ($request->query('btnType') == 'btnExcel') {
                $name = $namaFile . '.xlsx';
                $type = \Maatwebsite\Excel\Excel::XLSX;
                return Excel::download(new SuratKuasaExport($data), 'surat-kuasa.xlsx');

            } else {
                $name = $namaFile . '.pdf';
                $type = \Maatwebsite\Excel\Excel::MPDF;
                $data = [
                    'data' => $this->querySuratKuasa($request),
                ];
                $pdf = PDF::loadView('surat.surat-kuasa.pdf', $data)->setPaper('A4', 'landscape');
                return $pdf->stream($name);
            }
        }
        return redirect()->back()->with('fail', 'Tidak Ada Data');


    }

    public function querySuratKuasa($request)
    {
        $data = SuratKuasa::query() ->with(['suratKuasaDetail.sumberDana']) ;
        $bulan = $request->filled('bulan') && $request->bulan !== 'undefined' ? $request->bulan : null;
        $tahun = $request->filled('tahun') && $request->tahun !== 'undefined' ? $request->tahun : null;

        if ($bulan && $tahun) {
            $data->whereRaw('YEAR(tanggal) = "' . $request->tahun . '"');

            if ($request->bulan != 'all') {
                $data->whereRaw('MONTH(tanggal) = "' . $request->bulan . '"');
            }
        }

        $data = $data->orderBy('id', 'DESC')->get();
        return $data;
    }
}
