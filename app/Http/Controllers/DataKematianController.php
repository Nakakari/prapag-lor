<?php

namespace App\Http\Controllers;

use App\Exports\DataKematianExport;
use App\Helpers\AplikasiHelper;
use App\Helpers\BulanHelper;
use App\Http\Requests\DataKematianRequest;
use App\Imports\DataKematianImport;
use App\Models\DataKematian;
use App\Models\DataRw;
use App\Models\Setting\JenisKelamin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Throwable;

class DataKematianController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'rw' => DataRw::with('rts')->get(),
            'tahun' => DataKematian::select('tahun')->distinct()->get(),
            'bulan' => (new BulanHelper)->listBulan(),
            'data' => (new DataKematian())->getAll($request),
            'listPejabat' => (new DataKematian())->listPejabat(),
        ];
        return view('data-kematian.index', $data);
    }

    public function create()
    {
        $data = [
            'data' => null,
            'rw' => DataRw::with('rts')->get(),
            'jenisKelamin' => JenisKelamin::all(),
        ];
        return view('data-kematian.form', $data);
    }

    public function store(DataKematianRequest $request)
    {
        try {
            $form = array_merge($request->validated(), ['created_by' => Auth::user()->id]);
            DataKematian::create($form);
            $status = 'success-message';
            $message = 'Berhasil Tambah Data';
        } catch (Throwable $e) {
            $status = 'error-message';
            $message = 'Galat. Data Gagal Disimpan.';
        }
        return redirect()->route('data-kematian.index')->with($status, $message);
    }

    public function edit($id)
    {
        $dataKematian = DataKematian::findOrFail($id);
        $data = [
            'data' => $dataKematian,
            'rw' => DataRw::with('rts')->get(),
            'jenisKelamin' => JenisKelamin::all(),
        ];
        return view('data-kematian.form', $data);
    }

    public function update(DataKematianRequest $request, $id)
    {
        try {
            $data = DataKematian::findOrFail($id);
            $form = array_merge($request->validated(), [
                'updated_by' => Auth::user()->id,
                'tanggal_lahir' => ($request->tanggal_lahir ? $request->tanggal_lahir : $data->tanggal_lahir)
            ]);
            $data->update($form);
            $status = 'success-message';
            $message = 'Berhasil Update Data';
        } catch (Throwable $e) {
            $status = 'error-message';
            $message = 'Galat. Data Gagal Disimpan.';
        }
        return redirect()->route('data-kematian.index')->with($status, $message);
    }

    public function destroy($id)
    {
        $data = DataKematian::findOrFail($id);
        $data->delete();
        return redirect()->route('data-kematian.index')->with('success-message', 'Berhasil Hapus Data');
    }

    public function printSuratKematian(Request $request, $id)
    {
        $data = DataKematian::findOrFail($id);
        $title = 'LAPORAN MENINGGAL DUNIA - ' . $data->nik . ' - ' . $data->nama;
        $signature = collect(DataKematian::listPejabat());
        $signature = $signature->where('name', $request->signature)->first();
        return view('pdf.data-kematian.surat-keterangan-kematian', compact(['data', 'title', 'signature']));
    }

    public function printExcel(Request $request)
    {
        $data['year'] = isset($request->year) ? $request->year : date('Y');
        $data['start_month'] = isset($request->start_month) ? ($request->start_month == '00' ? '01' : $request->start_month) : '01';
        $data['end_month'] = isset($request->end_month) ? ($request->end_month == '00' ? '12' : $request->end_month) : '12';

        if (ltrim($data['start_month'], '0') > ltrim($data['end_month'], '0')) {
            $data['start_month'] = $request->end_month;
            $data['end_month'] = $request->start_month;
        }

        $data['title'] = 'LAPORAN MENINGGAL DUNIA DESA ' . AplikasiHelper::desa . ' KEC. ' . AplikasiHelper::kecamatan . ' KAB. ' . AplikasiHelper::kabupaten;
        $data['sub_title'] = 's/d BULAN  ' . ($data['start_month'] != '00' ? (new BulanHelper)->listBulan($data['start_month']) : 'Januari') . ' - ' . ($data['end_month'] != '00' ? (new BulanHelper)->listBulan($data['end_month']) : 'Desember') . ' - ' . $data['year'];
        $data['excel_title'] = 'BULAN  ' . ($data['start_month'] != '00' ? (new BulanHelper)->listBulan($data['start_month']) : 'Januari') . ' - ' . ($data['end_month'] != '00' ? (new BulanHelper)->listBulan($data['end_month']) : 'Desember') . ' - ' . $data['year'];

        $signature = collect(DataKematian::listPejabat());
        $data['signature'] = $signature->where('name', $request->signature)->first();

        $data['data'] = DataKematian::where('tahun', $data['year'])
            ->whereMonth('tanggal_pemakaman', '>=', $data['start_month'])
            ->whereMonth('tanggal_pemakaman', '<=', $data['end_month'])
            ->orderBy('tanggal_pemakaman', 'DESC')
            ->get();
        // dd($data);
        $data['desa'] = AplikasiHelper::desa;
        if ($data['data']->count()) {
            return Excel::download(new DataKematianExport($data), 'laporan-kematian-' . $data['excel_title'] . '.xlsx');
        }
        return redirect()->back()->with('fail', 'Tidak Ada Data');
    }

    public function print(Request $request)
    {

        $data['year'] = isset($request->year) ? $request->year : date('Y');
        $data['start_month'] = isset($request->start_month) ? ($request->start_month == '00' ? '01' : $request->start_month) : '01';
        $data['end_month'] = isset($request->end_month) ? ($request->end_month == '00' ? '12' : $request->end_month) : '12';

        if (ltrim($data['start_month'], '0') > ltrim($data['end_month'], '0')) {
            $data['start_month'] = $request->end_month;
            $data['end_month'] = $request->start_month;
        }

        $data['title'] = 'LAPORAN MENINGGAL DUNIA DESA ' . AplikasiHelper::desa . ' KEC. ' . AplikasiHelper::kecamatan . ' KAB. ' . AplikasiHelper::kabupaten;
        $data['sub_title'] = 's/d BULAN  ' . ($data['start_month'] != '00' ? (new BulanHelper)->listBulan($data['start_month']) : 'Januari') . ' - ' . ($data['end_month'] != '00' ? (new BulanHelper)->listBulan($data['end_month']) : 'Desember') . ' - ' . $data['year'];
        $data['pdf_title'] = 'BULAN  ' . ($data['start_month'] != '00' ? (new BulanHelper)->listBulan($data['start_month']) : 'Januari') . ' - ' . ($data['end_month'] != '00' ? (new BulanHelper)->listBulan($data['end_month']) : 'Desember') . ' - ' . $data['year'] . '.pdf';

        $signature = collect(DataKematian::listPejabat());
        $data['signature'] = $signature->where('name', $request->signature)->first();


        $data['data'] = DataKematian::where('tahun', $data['year'])
            ->whereMonth('tanggal_pemakaman', '>=', $data['start_month'])
            ->whereMonth('tanggal_pemakaman', '<=', $data['end_month'])
            ->orderBy('tanggal_pemakaman', 'DESC')
            ->get();


        if ($data['data']->count()) {

            // return view('pdf.buku-pemakaman', compact(['data']));

            $pdf = PDF::loadView('pdf.data-kematian.data-kematian', compact(['data']))->setPaper('a4', 'landscape');
            return $pdf->download($data['pdf_title']);
        }
        return redirect()->back()->with('fail', 'Tidak Ada Data');
    }

    public function uploadForm()
    {
        return view('data-kematian.upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'upload_buku_pemakaman' => 'required|mimes:xlsx,xls,csv',
        ]);
        Excel::import(new DataKematianImport, request()->file('upload_buku_pemakaman'));
        return redirect()->route('data-kematian.index');
    }
}
