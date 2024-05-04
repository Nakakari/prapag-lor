<?php

namespace App\Helpers;

use App\Helpers\FilterMonografiPendudukHelper;
use App\Models\DataRt;
use App\Models\DataRw;
use App\Models\Penduduk;
use App\Models\Setting\JenisPekerjaan;

class GetDataMonografiHelper
{
    public static function parsingData($rt, $rw, $kondisi)
    {
        $jenisMonografi = $kondisi;

        if (isset($rt) && isset($rw)) {
            $getRw[] = $rw;
        } else if (!isset($rt) && isset($rw)) {
            $getRw[] = $rw;
        } else {
            $getRw = (new DataRw())->listData();
        }
        if (isset($rt) && isset($rw)) {
            $getRt[] = $rt;
        } else {
            $getRt = (new DataRt())->listData();
        }

        if ($jenisMonografi == FilterMonografiPendudukHelper::BerdasarJenisKelamin) { //jenis kelamin
            $data['data'] = (new Penduduk())->monografiJenisKelamin($getRw, $getRt);
            // dd($data);
            $view = 'penduduk.data-monografi.jenis-kelamin';
            $export = 'penduduk.export.monografi-jenis-kelamin';
            $judul = FilterMonografiPendudukHelper::BerdasarJenisKelaminText;
        } elseif (
            $jenisMonografi == FilterMonografiPendudukHelper::BerdasarAgama ||
            $jenisMonografi == FilterMonografiPendudukHelper::BerdasarGolDar ||
            $jenisMonografi == FilterMonografiPendudukHelper::BerdasarStatusKawin ||
            $jenisMonografi == FilterMonografiPendudukHelper::BerdasarJenisPendidikan
        ) {
            $data['data'] = (new Penduduk())->monografiAgama($getRw, $getRt, $kondisi);
            // dd($data);
            $view = 'penduduk.data-monografi.agama';
            $export = 'penduduk.export.monografi-agama';
            if ($jenisMonografi == FilterMonografiPendudukHelper::BerdasarAgama) {
                $judul = FilterMonografiPendudukHelper::BerdasarAgamaText;
                $total_row = 23;
            } else if ($jenisMonografi == FilterMonografiPendudukHelper::BerdasarGolDar) {
                $judul = FilterMonografiPendudukHelper::BerdasarGolDarText;
            } else if ($jenisMonografi == FilterMonografiPendudukHelper::BerdasarStatusKawin) {
                $judul = FilterMonografiPendudukHelper::BerdasarStatusKawinText;
            } else if ($jenisMonografi == FilterMonografiPendudukHelper::BerdasarJenisPendidikan) {
                $judul = FilterMonografiPendudukHelper::BerdasarJenisPendidikanText;
            }
            $judul = $judul;
        } elseif ($jenisMonografi == FilterMonografiPendudukHelper::BerdasarUmur) {
            $data['data'] = (new Penduduk())->monografiUmur($getRw, $getRt);
            // dd($data);
            $view = 'penduduk.data-monografi.umur';
            $export = 'penduduk.export.monografi-umur';
            $judul = FilterMonografiPendudukHelper::BerdasarUmurText;
        } elseif ($jenisMonografi == FilterMonografiPendudukHelper::BerdasarKepalaKeluarga) {
            $data['data'] = (new Penduduk())->monografiKepala($getRw, $getRt);
            $view = 'penduduk.data-monografi.kepala';
            $export = 'penduduk.export.monografi-kepala';
            $judul = FilterMonografiPendudukHelper::BerdasarKepalaKeluargaText;
        } else if ($jenisMonografi == FilterMonografiPendudukHelper::BerdasarJenisPekerjaan) {
            $data['data'] = (new Penduduk())->monografiPekerjaan($getRw, $getRt);
            // dd($data['data']);
            $view = 'penduduk.data-monografi.jenis-pekerjaan';
            $export = 'penduduk.export.monografi-jenis-pekerjaan';
            $judul = FilterMonografiPendudukHelper::BerdasarJenisPekerjaanText;
        }
        $request = [
            'rt' => $rt,
            'rw' => $rw,
            'kondisi' => $kondisi,
        ];
        $data['data']['judul'] = !empty($judul) ? $judul : '';
        return [
            'data' => $data,
            'view' => $view,
            'request' => $request,
            'export' => $export,
            'judul' => $judul,
        ];
    }
}
