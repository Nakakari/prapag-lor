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

    .border_all_last {
        border: 1px solid black;
    }
</style>
<table style="border-collapse: separate; border-spacing: 0;" width="100%">

    <thead>
        <tr>
            <th colspan="13" style="font-weight: bold;">
                PEMERINTAH DESA {{ strtoupper(AplikasiHelper::desa) }}<br>
                {{ strtoupper(AplikasiHelper::desa . ', ' . AplikasiHelper::kecamatan . ', ' . AplikasiHelper::kabupaten . ', ' . AplikasiHelper::provinsi) }}
            </th>
        </tr>
        <tr>
            <th colspan="13" style="text-align: center; font-weight: bold;">SURAT KUASA
            </th>
        </tr>
        <tr>
            <th colspan="13">&nbsp;</th>
        </tr>

        <tr>
            <th rowspan="2" class="border_all_non_right">NO</th>
            <th rowspan="2" class="border_all_non_right">NOMOR SURAT</th>
            <th rowspan="2" class="border_all_non_right">TANGGAL SURAT</th>
            <th colspan="2" class="border_all_non_right" style="text-align: center">PEMBERI KUASA</th>
            <th colspan="2" class="border_all_non_right" style="text-align: center">PENERIMA KUASA</th>
            <th rowspan="2" class="border_all_non_right">PERIODE KUASA</th>
            <th rowspan="2" class="border_all_non_right">NOMINAL</th>
            <th rowspan="2" class="border_all_non_right">SUMBER DANA</th>
            <th rowspan="2" style=" border: 1px solid black;">
                PEMBUAT SURAT</th>
        </tr>
        <tr>
            <th class="border_all_non_right">NIK</th>
            <th class="border_all_non_right">NAMA</th>
            <th class="border_all_non_right">NIK</th>
            <th class="border_all_non_right">NAMA</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($data as $row)
            <tr>
                <td class="border_all_non_right" style="text-align:center;">{{ $loop->iteration }}</td>
                <td class="border_all_non_right">{{ $row->nomor_surat }}</td>
                <td class="border_all_non_right">{{ date('d/m/Y', strtotime($row->tanggal)) }}</td>

                <td class="border_all_non_right">"{{ $row->nik_pemberi_kuasa }}</td>
                <td class="border_all_non_right">{{ $row->nama_pemberi_kuasa }}</td>

                <td class="border_all_non_right">"{{ $row->nik_penerima_kuasa }}</td>
                <td class="border_all_non_right">{{ $row->nama_penerima_kuasa }}</td>

                <td class="border_all_non_right">
                    {{ Carbon::createFromFormat('Y-m-d', $row->start_date)->locale('id')->translatedFormat('d F Y') }}
                    s.d.
                    {{ Carbon::createFromFormat('Y-m-d', $row->end_date)->locale('id')->translatedFormat('d F Y') }}
                </td>

                <td class="border_all_non_right text-end">
                    {{ number_format($row->nominal, 2, ',', '.') }}
                </td>

                <td class="border_all_non_right">{{ $row->sumberDana->nama }}</td>

                {{-- kolom terakhir wajib pakai border_all, bukan border_all_non_right --}}
                <td class="border_all_last">{{ $row->user->name }}</td>
            </tr>
        @endforeach
    </tbody>

</table>

</table>
