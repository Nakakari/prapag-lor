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
                REKAPITULASI PENDUDUK
                BERDASARKAN KEPALA KELUARGA</th>
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
                <th colspan="{{ $totalCol }}" style="text-align: left;">NO RW :
                    00{{ isset($keyrw) ? $keyrw : '' }}</th>
            </tr>
            <tr>
                <th rowspan="2" style="border: 1px solid black;border-collapse: collapse; background: #d3d3d3;">NO
                </th>
                <th rowspan="2" style="border: 1px solid black;border-collapse: collapse; background: #d3d3d3;">NO RT
                </th>
                <th colspan="3" style="border: 1px solid black;border-collapse: collapse; background: #d3d3d3;">
                    JUMLAH KEPALA KELUARGA</th>
            </tr>
            <tr>
                <th style="border: 1px solid black;border-collapse: collapse; background: #d3d3d3;">LAKI-LAKI</th>
                <th style="border: 1px solid black;border-collapse: collapse; background: #d3d3d3;">PEREMPUAN</th>
                <th style="border: 1px solid black;border-collapse: collapse; background: #d3d3d3;">JUMLAH</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rw['rt'] as $keyrt => $rt)
                <tr>
                    <td class="text-center" style="border: 1px solid black;border-collapse: collapse;">
                        {{ $keyrt }}</td>
                    <td>RT.00{{ $keyrt }}</td>
                    <td class="text-right" style="border: 1px solid black;border-collapse: collapse;">
                        {{ count($rt['L']) }}</td>
                    <td class="text-right" style="border: 1px solid black;border-collapse: collapse;">
                        {{ count($rt['P']) }}</td>
                    <td class="text-right" style="border: 1px solid black;border-collapse: collapse;">
                        {{ count($rt['L']) + count($rt['P']) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td class="text-center" colspan="2" style="border: 1px solid black;border-collapse: collapse;">Jumlah
                    RW : 00{{ $keyrw }}</td>
                <td class="text-right" style="border: 1px solid black;border-collapse: collapse;">{{ $rw['tlaki'] }}
                </td>
                <td class="text-right" style="border: 1px solid black;border-collapse: collapse;">{{ $rw['tperem'] }}
                </td>
                <td class="text-right" style="border: 1px solid black;border-collapse: collapse;">
                    {{ $rw['tlaki'] + $rw['tperem'] }}</td>
            </tr>
            <tr>
                <td colspan="{{ $totalCol }}">&nbsp;</td>
            </tr>
        </tfoot>
    </table>
    <?php
    $jmlLaki += $rw['tlaki'];
    $jmlPerempuan += $rw['tperem'];
    ?>
@endforeach
<table style="border-collapse: collapse;" width="100%">
    <tfoot>
        <tr>
            <th style="background: #d3d3d3; border: 1px solid black;border-collapse: collapse;" width="8%">NO
            </th>
            <th style="background: #d3d3d3; border: 1px solid black;border-collapse: collapse;">NO RT</th>
            <th style="background: #d3d3d3; border: 1px solid black;border-collapse: collapse;">LAKI-LAKI</th>
            <th style="background: #d3d3d3; border: 1px solid black;border-collapse: collapse;">PEREMPUAN</th>
            <th style="background: #d3d3d3; border: 1px solid black;border-collapse: collapse;">JUMLAH</th>
        </tr>
        <tr>
            <td class="text-right" colspan="2"
                style="border: 1px solid black;border-collapse: collapse; font-weight: bold; background: #d3d3d3;">
                JUMLAH TOTAL</td>
            <td class="text-right" style="border: 1px solid black;border-collapse: collapse; background: #d3d3d3;">
                {{ $jmlLaki }}
            </td>
            <td class="text-right" style="border: 1px solid black;border-collapse: collapse; background: #d3d3d3;">
                {{ $jmlPerempuan }}
            </td>
            <td class="text-right" style="border: 1px solid black;border-collapse: collapse; background: #d3d3d3;">
                {{ $jmlLaki + $jmlPerempuan }}</td>
        </tr>
    </tfoot>
</table>
