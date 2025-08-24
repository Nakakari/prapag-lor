<html>
<?php
use Carbon\Carbon;
use App\Helpers\AplikasiHelper;
use App\Helpers\TerbilangHelper;
?>

<head>
    <style>

    </style>
</head>

<body style="font-family: Calibri, sans-serif; font-size: 12px; overflow-x:auto;">

    <?php
    $terbilang = new TerbilangHelper()->terbilang($data->nominal ?? 0);
    ?>
    <table width="100%" style="padding:0;border-spacing:0px;">
        @include('bagian-cetak-surat.kop')
    </table>
    <table width="100%" style="padding:0;border-spacing:0px; margin-top: 10px;">
        <tr>
            <table width="100%" style="margin:;border-spacing:0px;">
                <tr>
                    <td colspan="4" style="padding-left: 40px;"> Yang bertanda tangan di bawah ini saya :</td>
                </tr>
                <tr>
                    <td width="2%" style="padding-left: 60px;">I.</td>
                    <td width="20%">Nama</td>
                    <td width="2%"> : </td>
                    <td width="56%">{{ $data->nama_pemberi_kuasa }}</td>
                </tr>
                <tr>
                    <td width="2%" style="padding-left: 60px;">&nbsp;</td>
                    <td width="20%">Jabatan</td>
                    <td width="2%"> : </td>
                    <td width="56%">{{ $data->jabatan_pemberi_kuasa }}</td>
                </tr>
                <tr>
                    <td width="2%" style="padding-left: 60px;">&nbsp;</td>
                    <td width="20%">NIK</td>
                    <td width="2%"> : </td>
                    <td width="56%">{{ $data->nik_pemberi_kuasa }}</td>
                </tr>
                <tr>
                    <td width="2%" style="padding-left: 60px;">&nbsp;</td>
                    <td width="20%">Alamat</td>
                    <td width="2%"> : </td>
                    <td width="56%">{{ $data->alamat_pemberi_kuasa }}</td>
                </tr>
                <tr>
                    <td width="2%" style="padding-left: 60px;">&nbsp;</td>
                    <td width="20%">No. Telp/HP</td>
                    <td width="2%"> : </td>
                    <td width="56%">{{ $data->no_hp_pemberi_kuasa }}</td>
                </tr>
                {{-- Penerima Kuasa --}}
                <tr>
                    <td width="2%" style="padding-left: 60px;">II.</td>
                    <td width="20%">Nama</td>
                    <td width="2%"> : </td>
                    <td width="56%">{{ $data->nama_penerima_kuasa }}</td>
                </tr>
                <tr>
                    <td width="2%" style="padding-left: 60px;">&nbsp;</td>
                    <td width="20%">Jabatan</td>
                    <td width="2%"> : </td>
                    <td width="56%">{{ $data->jabatan_penerima_kuasa }}</td>
                </tr>
                <tr>
                    <td width="2%" style="padding-left: 40px;">&nbsp;</td>
                    <td width="20%">NIK</td>
                    <td width="2%"> : </td>
                    <td width="56%">{{ $data->nik_penerima_kuasa }}</td>
                </tr>
                <tr>
                    <td width="2%" style="padding-left: 40px;">&nbsp;</td>
                    <td width="20%">Alamat</td>
                    <td width="2%"> : </td>
                    <td width="56%">{{ $data->alamat_penerima_kuasa }}</td>
                </tr>
                <tr>
                    <td width="2%" style="padding-left: 40px;">&nbsp;</td>
                    <td width="20%">No. Telp/HP</td>
                    <td width="2%"> : </td>
                    <td width="56%">{{ $data->no_hp_penerima_kuasa }}</td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-left: 40px;">Selanjutnya disebut Pemberi Kuasa mewakili
                        Pemerintah Desa
                        {{ AplikasiHelper::desa }}</td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-left: 40px;">Dengan ini menunjuk dan memberikan kuasa kepada :
                    </td>
                </tr>
                <tr>
                    <td width="2%" style="padding-left: 40px;">&nbsp;</td>
                    <td width="20%">Nama</td>
                    <td width="2%"> : </td>
                    <td width="56%">{{ $data->nama_penerima_kuasa }}</td>
                </tr>
                <tr>
                    <td width="2%" style="padding-left: 40px;">&nbsp;</td>
                    <td width="20%">Jabatan</td>
                    <td width="2%"> : </td>
                    <td width="56%">{{ $data->jabatan_penerima_kuasa }}</td>
                </tr>
                <tr>
                    <td width="2%" style="padding-left: 40px;">&nbsp;</td>
                    <td width="20%">NIK</td>
                    <td width="2%"> : </td>
                    <td width="56%">{{ $data->nik_penerima_kuasa }}</td>
                </tr>
                <tr>
                    <td width="2%" style="padding-left: 40px;">&nbsp;</td>
                    <td width="20%">Alamat</td>
                    <td width="2%"> : </td>
                    <td width="56%">{{ $data->alamat_penerima_kuasa }}</td>
                </tr>
                <tr>
                    <td width="2%" style="padding-left: 40px;">&nbsp;</td>
                    <td width="20%">No. Telp/HP</td>
                    <td width="2%"> : </td>
                    <td width="56%">{{ $data->no_hp_penerima_kuasa }}</td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-left: 40px;">Selanjutnya disebut Penerima Kuasa</td>
                </tr>
            </table>
        </tr>
        <tr>
            <table width="100%" style="margin-top:10px;border-spacing:0px;">
                <tr>
                    <td colspan="2" style="padding-left: 40px;"> Bersama dengan surat ini kami selaku Pemberi
                        Kuasa menunjuk Penerima Kuasa untuk : </td>
                </tr>
                <tr>
                    <td width="2%" style="padding-left: 60px;">1.</td>
                    <td width="20%">Menerima Uang
                    </td>
                </tr>
                <tr>
                    <td width="2%" style="padding-left: 60px;">2.</td>
                    <td width="20%">Menandatangani slip penarikan dan menerima uang
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-left: 40px;"> dengan nama Rekening <b>Kas Desa
                            {{ AplikasiHelper::desa }} {{ AplikasiHelper::kecamatan }}</b> dengan No. Rekening
                        {{ AplikasiHelper::no_rekening }} dengan nominal sebesar
                        <b>Rp.{{ number_format($data->nominal) }},- (<b><i>{{ ucfirst(strtolower($terbilang)) }}
                                    rupiah</i></b>)</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-left: 40px;"> Surat Kuasa ini berlaku :</td>
                </tr>
                <tr>
                    <td width="2%" style="padding-left: 60px;">1.</td>
                    <td width="20%">Dari tanggal
                        {{ Carbon::createFromFormat('Y-m-d', $data->start_date)->locale('id')->translatedFormat('d F Y') }}
                        s/d
                        {{ Carbon::createFromFormat('Y-m-d', $data->end_date)->locale('id')->translatedFormat('d F Y') }}
                    </td>
                </tr>
                <tr>
                    <td width="2%" style="padding-left: 60px;">2.</td>
                    <td width="20%">Hanya 1 (satu) kali</td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-left: 40px;">
                        Hal-hal serta segala risiko yang mana disebabkan oleh surat ini akan menjadi tanggung jawab
                        dari pemberi kuasa sepenuhnya.
                    </td>
                </tr>
            </table>
        </tr>

        <tr>
            <table width="100%" style="margin-top:10px;border-spacing:0px;">
                <tr>
                    <td style="padding-left: 40px;"> Demikian surat kuasa ini kami buat dengan penuh kesadaran dan
                        sebenarnya tanpa ada paksaan dari pihak manapun serta dapat digunakan sebagaimana mestinya.
                    </td>
                </tr>
            </table>
        </tr>


        <tr>
            <table width="100%" style="margin-top: 10px;border-spacing:0px;">
                <tr>
                    <td width="50%">&nbsp;</td>
                    <td width="50%" style="text-align: center;">{{ AplikasiHelper::desa }},
                        {{ Carbon::createFromFormat('Y-m-d', $data->tanggal)->locale('id')->translatedFormat('d F Y') }}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;vertical-align: bottom">
                        Penerima Kuasa</td>
                    <td style="text-align: center;vertical-align: text-top;">
                        Pemberi Kuasa
                    </td>

                </tr>
                <tr>
                    <td style="text-align: center;">&nbsp;</td>
                    <td style="text-align: center;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align: center;">
                        <br>
                        <br>
                        <br>
                        <br>
                    </td>
                    <td style="text-align: center;">
                        <br>
                        <br>
                        <br>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;">
                        {{ $data->nama_penerima_kuasa }}
                    </td>
                    <td style="text-align: center;">
                        {{ $data->nama_pemberi_kuasa }}
                    </td>
                </tr>
            </table>
        </tr>

    </table>
</body>

</html>
