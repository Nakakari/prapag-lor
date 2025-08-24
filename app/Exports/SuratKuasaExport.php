<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class SuratKuasaExport extends DefaultValueBinder implements ShouldAutoSize, FromView, WithColumnFormatting
{
    protected $data;
    public function __construct($data)
    {

        $this->data = $data;
    }

    public function columnFormats(): array
    {
        return [];
    }
    public function view(): View
    {
        return view('surat.surat-kuasa.excel', [
            'data' => $this->data,
        ]);
    }
}
