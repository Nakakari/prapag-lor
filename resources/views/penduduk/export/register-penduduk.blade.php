@php
    error_reporting(0);
    use Carbon\Carbon;
    use App\Helpers\AplikasiHelper;
@endphp
<table style="border-collapse: collapse;">
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
            <th rowspan="2">NO</th>
            <th rowspan="2">NIK</th>
            <th rowspan="2">NO KK</th>
            <th rowspan="2">NAMA</th>
            <th rowspan="2">JENIS KELAMIN</th>
            <th rowspan="2">TEMPAT LAHIR</th>
            <th rowspan="2">TGL LAHIR</th>
            <th rowspan="2">SHDK</th>
            <th colspan="2">ALAMAT</th>
            <th rowspan="2">PENDIDIKAN</th>
            <th rowspan="2">PEKERJAAN</th>
            <th rowspan="2">UMUR</th>
            <th rowspan="2">NAMA AYAH</th>
            <th rowspan="2">NAMA IBU</th>
        </tr>
        <tr>
            <th>RT</th>
            <th>RW</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
                <td style="text-align:center;">{{ $loop->iteration }}</td>
                <td style="">
                    '{{ $row->nik }}
                </td>
                <td style="">
                    '{{ $row->no_kk }}
                </td>
                <td style="">
                    {{ strtoupper($row->nama) }}
                </td>
                <td style="">
                    {{ strtoupper($row->gender->name) }}
                </td>
                </td>
                <td style="">
                    {{ strtoupper($row->tempat_lahir) }}
                </td>
                <td style="">

                    {{ date('d-m-Y', strtotime($row->tanggal_lahir)) }}


                </td>
                <td style="">
                    {{ strtoupper($row->statusRelation->nama) }}
                </td>
                <td style="">
                    00{{ $row->rt->name }}
                </td>
                <td style="">
                    00{{ $row->rw->name }}

                </td>
                <td style="">
                    {{ strtoupper($row->pendidikan->nama) }}
                </td>
                <td style="">
                    {{ strtoupper($row->pekerjaan->deskripsi) }}
                </td>
                <td style="">
                    {{ Carbon::parse($row->tanggal_lahir)->age }}

                </td>
                <td style="">
                    {{ $row->nama_ayah }}

                </td>
                <td style="">
                    {{ $row->nama_ibu }}

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
