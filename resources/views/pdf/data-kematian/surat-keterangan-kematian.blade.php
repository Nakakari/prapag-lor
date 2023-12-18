@extends('pdf.layouts.layouts-rkpd')
@section('title', $data->title)
<?php
use App\Helpers\AplikasiHelper;
?>
@section('content')
    <style>
        body {
            margin-top: 2.5cm;
            font-size: 12pt;
        }

        table>thead>tr>th {
            vertical-align: middle !important;
            text-align: center;
            font-size: 12pt;
        }

        table>tbody>tr>td {
            font-size: 12pt;
        }
    </style>
    <div class="col-lg-12">
        <h5 class="text-center mb-3">
            UNTUK YANG BERSANGKUTAN
            <br>
            <u>SURAT KEMATIAN</u>
            <br>
            NOMOR: 474.3/{{ $data->id }}/{{ App\Models\DataKematian::rome_month(date('m')) }}/{{ date('Y') }}
        </h5>

        <div class="w-75 d-block mx-auto">
            <p>
                Yang bertanda tangan dibawah ini menerangkan bahwa:
            </p>

            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <td width="30%">NIK</td>
                        <td width="70%">: {{ $data->nik }}</td>
                    </tr>
                    <tr>
                        <td width="30%">Nama</td>
                        <td width="70%">: {{ $data->nama }}</td>
                    </tr>
                    <tr>
                        <td width="30%">Umur</td>
                        <td width="70%">: {{ $data->tanggal_lahir ? $data->tanggal_lahir->age : '-' }} Tahun</td>
                    </tr>
                    <tr>
                        <td width="30%">Alamat</td>
                        <td width="70%">
                            : Desa {{ AplikasiHelper::desa }} RT {{ $data->rt->name }} RW {{ $data->rw->name }} Kec.
                            {{ AplikasiHelper::kecamatan }} Kab. {{ AplikasiHelper::kabupaten }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <p>
                Nama tersebut telah meninggal dunia pada:
            </p>

            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <td width="30%">Hari</td>
                        <td width="70%">:
                            {{ $data->tanggal_pemakaman ? ucwords(App\Models\DataKematian::indo_date($data->tanggal_pemakaman->format('N'))) : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Tanggal</td>
                        <td width="70%">:
                            {{ $data->tanggal_pemakaman ? $data->tanggal_pemakaman->format('d-m-Y') : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Di</td>
                        <td width="70%">: {{ $data->tempat_tanggal_meninggal }}</td>
                    </tr>
                    <tr>
                        <td width="30%">Disebabkan Karena</td>
                        <td width="70%">
                            : {{ $data->penyebab_kematian }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <p>
                Demikian surat keterangan ini dibuat atas dasar yang sebenarnya.
            </p>

            <table style="width: 100%;">
                <tbody>
                    <tr>
                        <td style="width: 50%;">

                        </td>
                        <td style="width: 50%;" align="center">
                            <div class="text-center">
                                <p>{{ AplikasiHelper::desa }}, {{ date('d F Y') }}</p>
                                <p>
                                    @if ($signature)
                                        @if ($signature['jabatan'] == 'Kepala Desa {{ AplikasiHelper::desa }}')
                                            {{ $signature['jabatan'] }}
                                        @else
                                            An. Kepala Desa {{ AplikasiHelper::desa }}
                                            <br>
                                            {{ strtoupper($signature['jabatan']) }}
                                        @endif
                                    @else
                                        KEPALA DESA {{ AplikasiHelper::desa }}
                                    @endif
                                </p>
                                <br><br><br>
                                <p style="font-weight: 700;">
                                    @if ($signature)
                                        {{ strtoupper($signature['name']) }}
                                    @else
                                        {{ AplikasiHelper::kades }}
                                    @endif
                                </p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>


    </div>

    <script type="text/javascript">
        window.onload = window.print;
    </script>
@endsection
