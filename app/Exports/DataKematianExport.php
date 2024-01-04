<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class DataKematianExport extends DefaultValueBinder implements ShouldAutoSize, FromView, WithColumnFormatting
{
    protected $data;
    public function __construct($data)
    {

        $this->data = $data;
    }

    public function columnFormats(): array
    {
        return [
            'B' => DataType::TYPE_STRING,
        ];
    }

    public function view(): View
    {
        return view('exports.data-kematian.data-kematian', [
            'data' => $this->data,
        ]);
    }
}
