<?php

namespace App\Exports;

use App\Models\Penduduk;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class RegisterPendudukExport implements FromView, WithEvents, ShouldAutoSize
{
    protected $nik, $no_kk, $nama, $pendidikan, $umur, $umur2, $pekerjaan, $goldar, $gender, $agama, $rw, $rt;
    function __construct($nik, $no_kk, $nama, $pendidikan, $umur, $umur2, $pekerjaan, $goldar, $gender, $agama, $rw, $rt)
    {
        $this->nik = $nik;
        $this->no_kk = $no_kk;
        $this->nama = $nama;
        $this->pendidikan = $pendidikan;
        $this->umur = $umur;
        $this->umur2 = $umur2;
        $this->pekerjaan = $pekerjaan;
        $this->goldar = $goldar;
        $this->gender = $gender;
        $this->agama = $agama;
        $this->rw = $rw;
        $this->rt = $rt;
    }

    public function title(): string
    {
        return 'Penduduk';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
                $event->sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

                // HEADER
                $cellHeaderTable = 'A4:O4';
                // $event->sheet->getDelegate()->getStyle($cellHeaderTable)->getFont()->setSize(13);
                $event->sheet->getDelegate()->getStyle($cellHeaderTable)->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle($cellHeaderTable)->applyFromArray(
                    [
                        'alignment' => [
                            'horizontal' => Alignment::HORIZONTAL_CENTER,
                            'vertical' => Alignment::VERTICAL_CENTER,
                            'wrapText' => true,
                        ]
                    ]
                );

                // HEADER & BODY
                $countCell = $this->queryExport()->count() + 3;
                $cellRange = 'A4:O' . $countCell;
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['black'],
                        ]
                    ]
                ];
                $event->sheet->getStyle($cellRange)->applyFromArray($styleArray);
            }
        ];
    }

    public function view(): View
    {
        $response = $this->queryExport();
        return view('penduduk.export.register-penduduk', [
            'data' => $response,
        ]);
    }

    public function queryExport()
    {
        $data = Penduduk::query();

        if ($this->rt && $this->rt) {
            $data->where(Penduduk::id_rt, $this->rt);
        }

        if ($this->rw && $this->rw) {
            $data->where(Penduduk::id_rw, $this->rw);
        }

        if ($this->nik && $this->nik != null) {
            $data->where(Penduduk::nik, '=', $this->nik);
        }
        if ($this->no_kk && $this->no_kk != null) {
            $data->where(Penduduk::no_kk, '=', $this->no_kk);
        }
        if ($this->nama && $this->nama != null) {
            $data->where(Penduduk::nama, '=', $this->nama);
        }

        if ($this->pendidikan && $this->pendidikan) {
            $data->where(Penduduk::id_jenis_pendidikan, $this->pendidikan);
        }

        if ($this->pekerjaan && $this->pekerjaan) {
            $data->where(Penduduk::id_master_pekerjaan, $this->pekerjaan);
        }

        if ($this->goldar && $this->goldar != null) {
            $data->where(Penduduk::id_jenis_golongan_darah, $this->goldar);
        }

        if ($this->gender && $this->gender) {
            $data->where(Penduduk::id_jenis_kelamin, $this->gender);
        }

        if ($this->agama && $this->agama) {
            $data->where(Penduduk::id_jenis_agama, $this->agama);
        }

        if ($this->umur && $this->umur != null) {
            $awal = date('Y') - $this->umur;
            $awal = Carbon::create($awal, 1, 1)->addYear()->format('Y-m-d');
            $data->whereRaw('tanggal_lahir < "' . $awal . '"');
        }
        if ($this->umur2 && $this->umur2 != null) {
            $akhir = date('Y') - $this->umur2;
            $akhir = Carbon::create($akhir, 1, 1)->format('Y-m-d');
            $data->whereRaw('tanggal_lahir >= "' . $akhir . '"');
        }

        $data->where('is_penduduk', true);

        if (auth()->user()->role == 'ketua_rt' && auth()->user()->ketua_rt) {
            $data->where(Penduduk::id_rt, auth()->user()->ketua_rt->rt);
            $data->where(Penduduk::id_rw, auth()->user()->ketua_rt->rw);
        }

        $data = $data->orderBy('created_at', 'DESC')->get();
        return $data;
    }
}
