<?php

namespace App\Helpers;

class PegawaiHelper
{
    public function listPegawai($key = null)
    {
        $data =  [
            ['id' => 1, 'nama' => 'FAKHRUDDIN ANDES RAKA, SH', 'jabatan' => 'Kepala Desa', 'nik' => '3329122912850008', 'Alamat' => 'Prapag Lor, RT. 002 / RW. 003 Kec. Losari Kab. Brebes', 'no_hp' => '081770631770'],
            ['id' => 2, 'nama' => 'SANTO', 'jabatan' => 'Kaur Keuangan', 'nik' => '3329120504820006', 'Alamat' => 'Prapag Lor, RT. 003 / RW. 001 Kec. Losari Kab. Brebes', 'no_hp' => '085157173337'],
        ];
        return $data;
    }
}
