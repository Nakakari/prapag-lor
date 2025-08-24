<?php

namespace App\Helpers;

use Carbon\Carbon;

class TerbilangHelper
{
    public function kekata($x)
    {
        $x = abs($x);
        $angka = array(
            "", "Satu", "Dua", "Tiga", "Empat", "Lima",
            "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas"
        );
        $temp = "";
        if ($x < 12) {
            $temp = " " . $angka[$x];
        } elseif ($x < 20) {
            $temp = $this->kekata($x - 10) . " Belas";
        } elseif ($x < 100) {
            $temp = $this->kekata($x / 10) . " Puluh" . $this->kekata($x % 10);
        } elseif ($x < 200) {
            $temp = " Seratus" . $this->kekata($x - 100);
        } elseif ($x < 1000) {
            $temp = $this->kekata($x / 100) . " Ratus" . $this->kekata($x % 100);
        } elseif ($x < 2000) {
            $temp = " Seribu" . $this->kekata($x - 1000);
        } elseif ($x < 1000000) {
            $temp = $this->kekata($x / 1000) . " Ribu" . $this->kekata($x % 1000);
        } elseif ($x < 1000000000) {
            $temp = $this->kekata($x / 1000000) . " Juta" . $this->kekata($x % 1000000);
        } elseif ($x < 1000000000000) {
            $temp = $this->kekata($x / 1000000000) . " Milyar" . $this->kekata(fmod($x, 1000000000));
        } elseif ($x < 1000000000000000) {
            $temp = $this->kekata($x / 1000000000000) . " Trilyun" . $this->kekata(fmod($x, 1000000000000));
        }
        return $temp;
    }

    public function terbilang($x, $style = 4)
    {
        if ($x < 0) {
            $hasil = "MINUS " . trim($this->kekata($x));
        } else {
            $hasil = trim($this->kekata($x));
        }
        switch ($style) {
            case 1:
                $hasil = strtoupper($hasil);
                break;
            case 2:
                $hasil = strtolower($hasil);
                break;
            case 3:
                $hasil = ucwords($hasil);
                break;
            default:
                $hasil = ucfirst($hasil);
                break;
        }
        return $hasil;
    }
}
