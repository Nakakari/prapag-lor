@php
    error_reporting(0);
    use Carbon\Carbon;
    use App\Helpers\AplikasiHelper;
@endphp
<table style="border-collapse: collapse;">
    <thead>
        <tr>
            <th colspan="14" style="font-weight: bold;">
                PEMERINTAH DESA {{ strtoupper(AplikasiHelper::desa) }}<br>
                {{ strtoupper(AplikasiHelper::desa . ', ' . AplikasiHelper::kecamatan . ', ' . AplikasiHelper::kabupaten . ', ' . AplikasiHelper::provinsi) }}
            </th>
        </tr>
        <tr>
            <th colspan="14" style="text-align: center; font-weight: bold;">SURAT KUASA
            </th>
        </tr>
        <tr>
            <th colspan="14">&nbsp;</th>
        </tr>

        <tr>
            <th rowspan="2">NO</th>
            <th rowspan="2">NOMOR SURAT</th>
            <th rowspan="2">TANGGAL SURAT</th>
            <th rowspan="2">SUMBER DANA</th>
            <th colspan="2" style="text-align: center">PEMBERI KUASA</th>
            <th colspan="2" style="text-align: center">PENERIMA KUASA</th>
            <th rowspan="2">PERIODE KUASA</th>
            <th rowspan="2">NOMINAL</th>
            <th rowspan="2">SUMBER DANA</th>
            <th rowspan="2">PEMBUAT SURAT</th>
        </tr>
        <tr>
            <th>NIK</th>
            <th>NAMA</th>
            <th>NIK</th>
            <th>NAMA</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($data as $row)
            <tr>
                <td style="text-align:center;">{{ $loop->iteration }}</td>
                <td>{{ $row->nomor_surat }}</td>
                <td>{{ date('d/m/Y', strtotime($row->tanggal)) }}</td>
                <td>
                    @foreach ($row->suratKuasaDetail as $detail)
                        {{ $detail->sumberDana->nama ?? '-' }},
                    @endforeach
                </td>

                <td>"{{ $row->nik_pemberi_kuasa }}</td>
                <td>{{ $row->nama_pemberi_kuasa }}</td>

                <td>"{{ $row->nik_penerima_kuasa }}</td>
                <td>{{ $row->nama_penerima_kuasa }}</td>

                <td>
                    {{ Carbon::createFromFormat('Y-m-d', $row->start_date)->locale('id')->translatedFormat('d F Y') }}
                    s.d.
                    {{ Carbon::createFromFormat('Y-m-d', $row->end_date)->locale('id')->translatedFormat('d F Y') }}
                </td>

                <td style="text-align:right;">
                    {{ number_format($row->nominal, 2, ',', '.') }}
                </td>

                <td>{{ $row->sumberDana->nama }}</td>

                <td>{{ $row->user->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</table>
