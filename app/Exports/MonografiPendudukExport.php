<?php

namespace App\Exports;

use App\Helpers\GetDataMonografiHelper;
use App\Services\PendudukService;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class MonografiPendudukExport implements FromView, WithEvents, ShouldAutoSize, WithTitle
{
    protected $rt, $rw, $kondisi;
    function __construct($rt, $rw, $kondisi)
    {
        $this->rt = $rt;
        $this->rw = $rw;
        $this->kondisi = $kondisi;
    }

    public function title(): string
    {
        return 'Monografi';
    }

    public function registerEvents(): array
    {
        $res = $this->queryExport();
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
                $event->sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

                // HEADER
                $cellHeaderTable = 'A7:I7';
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
                $data = $this->queryExport();
                $countCell = $data['data']['data']['rw'] + 3; // iki bos kudune iso $data['data']->count() atau ntah apa sing iso dicount ben ntuk total rowne sing keborder
                $cellRange = 'A7:I' . $countCell;
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
        // dd($response);
        return view($response['export'], [
            'data' => $response['data']['data'],
            'judul' => $response['judul']
        ]);
    }

    public function queryExport()
    {
        $response = GetDataMonografiHelper::parsingData($this->rt, $this->rw, $this->kondisi);
        return $response;
    }
}
