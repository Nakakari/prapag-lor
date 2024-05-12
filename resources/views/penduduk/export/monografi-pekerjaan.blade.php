@php
    error_reporting(0);
    use App\Helpers\AplikasiHelper;
    use Carbon\Carbon;
@endphp
<style>
    .text-center {
        text-align: center;
    }

    .text-right {
        text-align: right;
    }

    .text-left {
        text-align: left;
    }
</style>
<table width="100%" style="page-break-after: avoid;">
    <thead>
        <?php
        $totalCol = 5;
        ?>
        <tr>
            <th colspan="{{ $totalCol }}" style="text-align: center; font-weight: bold;">PEMERINTAH KABUPATEN
                {{ strtoupper(AplikasiHelper::kabupaten) }}</th>
        </tr>
        <tr>
            <th colspan="{{ $totalCol }}" style="text-align: center; font-weight: bold;">KECAMATAN
                {{ strtoupper(AplikasiHelper::kecamatan) }}</th>
        </tr>
        <tr>
            <th colspan="{{ $totalCol }}" style="text-align: center; font-weight: bold;">DESA/KELURAHAN
                {{ strtoupper(AplikasiHelper::desa) }}</th>
        </tr>
        <tr>
            <th colspan="{{ $totalCol }}" style="text-align: center; font-weight: bold; text-decoration: underline;">
                REKAPITULASI PENDUDUK {{ strtoupper($data['judul']) }}</th>
        </tr>
        <tr>
            <th colspan="{{ $totalCol }}" style="text-align: center; font-weight: bold;">Tgl.
                {{ Carbon::now()->format('d-m-Y') }}
            </th>
        </tr>
        <tr>
            <th colspan="{{ $totalCol }}"></th>
        </tr>
    </thead>
</table>
<?php
$jmlLaki = 0;
$jmlPerempuan = 0;
?>
@foreach ($data['rw'] as $keyrw => $rw)
    <table style="border-collapse: collapse;" width="100%">
        <thead>
            <tr>
                <th rowspan="3" class="bordered">NO</th>
                <th rowspan="3" class="bordered">PEKERJAAN</th>
                @foreach ($data['data']['berdasarkan']['RW'] as $key => $row)
                    <th colspan="{{ count($data['data']['berdasarkan']['RT']) * 3 }}" class="bordered">RW.
                        00{{ ucwords($row) }}
                    </th>
                @endforeach
            </tr>
            <tr>
                @for ($i = 0; $i < count($data['data']['berdasarkan']['RW']); $i++)
                    @foreach ($data['data']['berdasarkan']['RT'] as $key => $row)
                        <th colspan="3" class="bordered">RT. 00{{ ucwords($row) }}
                        </th>
                    @endforeach
                @endfor
            </tr>
            <tr>
                @for ($i = 0; $i < count($data['data']['berdasarkan']['RW']); $i++)
                    @for ($j = 0; $j < count($data['data']['berdasarkan']['RT']); $j++)
                        <th class="bordered">L</th>
                        <th class="bordered">P</th>
                        <th class="bordered">L+P</th>
                    @endfor
                @endfor
            </tr>
        </thead>
        <tbody>
            @php
                $nomor = 1;
            @endphp
            @foreach ($data['data']['pekerjaan'] as $key => $pekerjaan)
                <tr>
                    <td class="text-center">{{ $nomor++ }}</td>
                    <td>{{ $key }}</td>
                    @foreach ($pekerjaan['rw'] as $rw)
                        @foreach ($rw['rt'] as $rt)
                            <td>{{ $rt['L'] }}</td>
                            <td>{{ $rt['P'] }}</td>
                            <td>{{ $rt['L'] + $rt['P'] }}</td>
                        @endforeach
                    @endforeach
                </tr>
            @endforeach
        </tbody>
        <tfoot>

        </tfoot>
    </table>
@endforeach
