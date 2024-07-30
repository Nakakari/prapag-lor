@php
    error_reporting(0);
    use Carbon\Carbon;
    use App\Helpers\AplikasiHelper;
@endphp
<style>
    .border_top {
        border-top: 1px solid black;
    }

    .border_right {
        border-right: 1px solid black;
    }

    .border_bottom {
        border-bottom: 1px solid black;
    }

    .border_left {
        border-left: 1px solid black;
    }

    .border_all {
        border: 1px solid black;
    }

    .border_all_non_top {
        border-right: 1px solid black;
        border-bottom: 1px solid black;
        border-left: 1px solid black;
    }

    .border_all_non_left {
        border-right: 1px solid black;
        border-bottom: 1px solid black;
        border-top: 1px solid black;
    }

    .border_all_non_right {
        border-top: 1px solid black;
        border-bottom: 1px solid black;
        border-left: 1px solid black;
    }

    .text-end {
        text-align: right;
    }
</style>
<table style="border-collapse: collapse;" width="100%">
    <thead>
        <tr>
            {{-- <th style="text-align: left;">
                <img src="{{ AplikasiHelper::logo }}" alt="" height="60">
            </th> --}}
            <th colspan="15" style="font-weight: bold;">
                PEMERINTAH DESA {{ strtoupper(AplikasiHelper::desa) }}<br>
                {{ strtoupper(AplikasiHelper::desa . ', ' . AplikasiHelper::kecamatan . ', ' . AplikasiHelper::kabupaten . ', ' . AplikasiHelper::provinsi) }}
            </th>
        </tr>
        <tr>
            <th colspan="15" style="text-align: center; font-weight: bold;">DAFTAR PENDUDUK
            </th>
        </tr>
        <tr>
            <th colspan="15">&nbsp;</th>
        </tr>
        <tr>
            <th class="border_all_non_right" rowspan="2">NO</th>
            <th class="border_all_non_right" rowspan="2">NIK</th>
            <th class="border_all_non_right" rowspan="2">NO KK</th>
            <th class="border_all_non_right" rowspan="2">NAMA</th>
            <th class="border_all_non_right" rowspan="2">JENIS KELAMIN</th>
            <th class="border_all_non_right" rowspan="2">TEMPAT LAHIR</th>
            <th class="border_all_non_right" rowspan="2">TGL LAHIR</th>
            <th class="border_all_non_right" rowspan="2">SHDK</th>
            <th class="border_all_non_right" colspan="2">ALAMAT</th>
            <th class="border_all_non_right" rowspan="2">PENDIDIKAN</th>
            <th class="border_all_non_right" rowspan="2">PEKERJAAN</th>
            <th class="border_all_non_right" rowspan="2">UMUR</th>
            <th class="border_all_non_right" rowspan="2">NAMA AYAH</th>
            <th class="border_all" rowspan="2">NAMA IBU</th>
        </tr>
        <tr>
            <th class="border_all_non_right">RT</th>
            <th class="border_all_non_right">RW</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
                <td class="border_all_non_right" style="text-align:center;">{{ $loop->iteration }}</td>
                <td class="border_all_non_right" style="">
                    {{ $row->nik }}
                </td>
                <td class="border_all_non_right" style="">
                    {{ $row->no_kk }}

                </td>
                <td class="border_all_non_right" style="">
                    {{ strtoupper($row->nama) }}
                </td>
                <td class="border_all_non_right" style="">
                    {{ strtoupper($row->gender->name) }}
                </td>
                </td>
                <td class="border_all_non_right" style="">
                    {{ strtoupper($row->tempat_lahir) }}
                </td>
                <td class="border_all_non_right" style="">

                    {{ date('d-m-Y', strtotime($row->tanggal_lahir)) }}


                </td>
                <td class="border_all_non_right" style="">
                    {{ strtoupper($row->statusRelation->nama) }}
                </td>
                <td class="border_all_non_right" style="">
                    00{{ $row->rt->name }}
                </td>
                <td class="border_all_non_right" style="">
                    00{{ $row->rt->rw->name }}

                </td>
                <td class="border_all_non_right" style="">
                    {{ strtoupper($row->pendidikan->nama) }}
                </td>
                <td class="border_all_non_right" style="">
                    {{ strtoupper($row->pekerjaan->deskripsi) }}
                </td>
                <td class="border_all_non_right" style="">
                    {{ Carbon::parse($row->tanggal_lahir)->age }}

                </td>
                <td class="border_all_non_right" style="">
                    {{ $row->nama_ayah }}

                </td>
                <td class="border_all" style="">
                    {{ $row->nama_ibu }}

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
