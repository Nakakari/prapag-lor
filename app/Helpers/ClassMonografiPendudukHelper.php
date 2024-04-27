<?php

namespace App\Helpers;

use App\Helpers\FilterMonografiPendudukHelper;

class ClassMonografiPendudukHelper
{
    function fieldKondisi()
    {
        return [
            ['id' => FilterMonografiPendudukHelper::BerdasarJenisKelamin, 'nama' => FilterMonografiPendudukHelper::BerdasarJenisKelaminText],
            ['id' => FilterMonografiPendudukHelper::BerdasarAgama, 'nama' => FilterMonografiPendudukHelper::BerdasarAgamaText],
            ['id' => FilterMonografiPendudukHelper::BerdasarGolDar, 'nama' => FilterMonografiPendudukHelper::BerdasarGolDarText],
            ['id' => FilterMonografiPendudukHelper::BerdasarUmur, 'nama' => FilterMonografiPendudukHelper::BerdasarUmurText],
            ['id' => FilterMonografiPendudukHelper::BerdasarStatusKawin, 'nama' => FilterMonografiPendudukHelper::BerdasarStatusKawinText],
            ['id' => FilterMonografiPendudukHelper::BerdasarJenisPekerjaan, 'nama' => FilterMonografiPendudukHelper::BerdasarJenisPekerjaanText],
            ['id' => FilterMonografiPendudukHelper::BerdasarJenisPendidikan, 'nama' => FilterMonografiPendudukHelper::BerdasarJenisPendidikanText],
            ['id' => FilterMonografiPendudukHelper::BerdasarKepalaKeluarga, 'nama' => FilterMonografiPendudukHelper::BerdasarKepalaKeluargaText],
        ];
    }
}
