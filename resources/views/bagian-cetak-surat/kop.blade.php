<?php
use Carbon\Carbon;
use App\Helpers\AplikasiHelper;
use Illuminate\Support\Facades\Route;
?>
<tr>
    <td style="border-bottom: 3px solid #000; width: 20%;">
        <center>
            <img src="img/logo.png" style="width: 95px; height: 95px;padding-left: 20px; padding-bottom: 10px;"
                align="middle" />
        </center>
    </td>
    <td style="border-bottom: 3px solid #000;padding-left: 0px; padding-top:1px; padding-bottom:1px; width: 80%;">
        <center>
            <span style="font-size: 15px;">PEMERINTAH KABUPATEN
                {{ strtoupper(AplikasiHelper::kabupaten) }}</span><br>
            <span style="font-size: 15px;">KECAMATAN
                {{ strtoupper(AplikasiHelper::kecamatan) }}</span><br>
            <b style="font-size: 15px;">KANTOR KEPALA DESA
                {{ strtoupper(AplikasiHelper::desa) }}</b><br>
            <span style="font-size: 11px"><b>
                    {{ AplikasiHelper::jalan }} Kec.
                    {{ AplikasiHelper::kecamatan }} Kab.
                    {{ AplikasiHelper::kabupaten }} Kode Pos {{ AplikasiHelper::kode_pos }}</b></span>
        </center>
    </td>
</tr>
<tr>
    <td colspan="3">
        <table width="100%" style="padding-top:0;border-spacing:0px; margin-top: 10px;">
            <tr>
                <td
                    style="text-align: center;{{ Route::is('sptjm.cetak-pdf') ? 'padding-left:70px; padding-right:70px;' : '' }}">
                    <span style="text-decoration: underline;font-weight: bold;">{{ strtoupper($judul) }}</span><br>
                    NOMOR : {{ $data->nomor_surat }}
                </td>
            </tr>
        </table>
    </td>
</tr>
