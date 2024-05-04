<?php

namespace App\Services;

use App\Helpers\FilterMonografiPendudukHelper;
use App\Models\Penduduk as ModelsPenduduk;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class PendudukServiceImpl implements PendudukService
{

    public function delete($id)
    {
        try {
            DB::transaction(
                function () use ($id) {
                    $penduduk = ModelsPenduduk::findOrFail($id);
                    // SKCK::whereIn('id_penduduk', [$id])->delete();
                    // Log::info('SKCK Deleted');
                    // SKTM::whereIn('id_penduduk', [$id])->delete();
                    // Log::info('Suket Umum Deleted');
                    // SuratKeteranganTidakMampu::whereIn('id_penduduk', [$id])->delete();
                    // Log::info('Suket Tidak Mampu Deleted');
                    // SKU::whereIn('id_penduduk', [$id])->delete();
                    // Log::info('Suket Usaha Deleted');
                    // SuketDomisili::whereIn('id_penduduk', [$id])->delete();
                    // Log::info('Suket Domisili Deleted');
                    // Sptjm::whereIn('id_penduduk', [$id])->delete();
                    // Log::info('SPTJM Deleted');
                    // SuketBelumMenikah::whereIn('id_penduduk', [$id])->delete();
                    // Log::info('Suket Belum Menikah Deleted');
                    $penduduk->delete();
                    Log::info('Penduduk Deleted');
                }
            );
            return 200;
        } catch (Throwable $e) {
            report($e);
            return 404;
        }
    }

    public function namaMonografi($kondisi)
    {
        if ($kondisi == FilterMonografiPendudukHelper::BerdasarJenisKelamin) {
            $namaFile = FilterMonografiPendudukHelper::BerdasarJenisKelaminText;
        } else if ($kondisi == FilterMonografiPendudukHelper::BerdasarAgama) {
            $namaFile = FilterMonografiPendudukHelper::BerdasarAgamaText;
        } else if ($kondisi == FilterMonografiPendudukHelper::BerdasarGolDar) {
            $namaFile = FilterMonografiPendudukHelper::BerdasarGolDarText;
        } else if ($kondisi == FilterMonografiPendudukHelper::BerdasarUmur) {
            $namaFile = FilterMonografiPendudukHelper::BerdasarUmurText;
        } else if ($kondisi == FilterMonografiPendudukHelper::BerdasarStatusKawin) {
            $namaFile = FilterMonografiPendudukHelper::BerdasarStatusKawinText;
        } else if ($kondisi == FilterMonografiPendudukHelper::BerdasarJenisPekerjaan) {
            $namaFile = FilterMonografiPendudukHelper::BerdasarJenisPekerjaanText;
        } else if ($kondisi == FilterMonografiPendudukHelper::BerdasarJenisPendidikan) {
            $namaFile = FilterMonografiPendudukHelper::BerdasarJenisPendidikanText;
        } else if ($kondisi == FilterMonografiPendudukHelper::BerdasarKepalaKeluarga) {
            $namaFile = FilterMonografiPendudukHelper::BerdasarKepalaKeluargaText;
        } else {
            $namaFile = '';
        }

        return $namaFile;
    }
}
