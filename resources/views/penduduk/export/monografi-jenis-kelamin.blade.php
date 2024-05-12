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
                BERDASARKAN JENIS KELAMIN</th>
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
                <th colspan="5" style="text-align: left;">NO RW :
                    00{{ isset($keyrw) ? $keyrw : '' }}</th>
            </tr>
            <tr>
                <th style="background: #d3d3d3; border: 1px solid black;border-collapse: collapse;" width="8%">NO
                </th>
                <th style="background: #d3d3d3; border: 1px solid black;border-collapse: collapse;">NO RT</th>
                <th style="background: #d3d3d3; border: 1px solid black;border-collapse: collapse;">L</th>
                <th style="background: #d3d3d3; border: 1px solid black;border-collapse: collapse;">P</th>
                <th style="background: #d3d3d3; border: 1px solid black;border-collapse: collapse;">JUMLAH</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $p = 0;
            $l = 0;
            ?>
            @foreach ($rw['rt'] as $keyrt => $rt)
                <tr>
                    <td class="text-center" style="border: 1px solid black;border-collapse: collapse;">
                        {{ $keyrt }}</td>
                    <td class="text-center" style="border: 1px solid black;border-collapse: collapse;">
                        RT.00{{ $keyrt }}</td>
                    <td class="text-right" style="border: 1px solid black;border-collapse: collapse;">
                        {{ count($rt['L']) }}</td>
                    <td class="text-right" style="border: 1px solid black;border-collapse: collapse;">
                        {{ count($rt['P']) }}</td>
                    <td class="text-right" style="border: 1px solid black;border-collapse: collapse;">
                        {{ count($rt['L']) + count($rt['P']) }}</td>
                </tr>
                <?php $p += count($rt['P']);
                $l += count($rt['L']); ?>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td class="text-right" colspan="2"
                    style="border: 1px solid black;border-collapse: collapse; font-weight: bold; background: #d3d3d3;">
                    JUMLAH
                    RW : 00{{ $keyrw }}</td>
                <td class="text-right" style="border: 1px solid black;border-collapse: collapse; background: #d3d3d3;">
                    {{ $l }}
                </td>
                <td class="text-right" style="border: 1px solid black;border-collapse: collapse; background: #d3d3d3;">
                    {{ $p }}
                </td>
                <td class="text-right" style="border: 1px solid black;border-collapse: collapse; background: #d3d3d3;">
                    {{ $l + $p }}</td>
            </tr>
            <tr>
                <td colspan="{{ $totalCol }}">&nbsp;</td>
            </tr>
        </tfoot>
    </table>
    <?php
    $jmlLaki += $l;
    $jmlPerempuan += $p;
    ?>
@endforeach
<table style="border-collapse: collapse;" width="100%">
    <tfoot>
        <tr>
            <th style="background: #d3d3d3; border: 1px solid black;border-collapse: collapse;" width="8%">NO
            </th>
            <th style="background: #d3d3d3; border: 1px solid black;border-collapse: collapse;">NO RT</th>
            <th style="background: #d3d3d3; border: 1px solid black;border-collapse: collapse;">L</th>
            <th style="background: #d3d3d3; border: 1px solid black;border-collapse: collapse;">P</th>
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
