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
        $totalCol = count($data['berdasarkan']['list']);
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
                BERDASARKAN UMUR</th>
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
$jmlTotalP = 0;
$jmlTotalL = 0;
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
                @foreach ($data['berdasarkan']['list'] as $key => $row)
                    <th colspan="3" style="border: 1px solid black;border-collapse: collapse; background: #d3d3d3;">
                        {{ ucwords($row) }}
                    </th>
                @endforeach
                <th colspan="3" style="border: 1px solid black;border-collapse: collapse; background: #d3d3d3;">
                    JUMLAH</th>
            </tr>
            <tr>
                @for ($i = 0; $i <= count($data['berdasarkan']['list']); $i++)
                    <th style="border: 1px solid black;border-collapse: collapse; background: #d3d3d3;">L</th>
                    <th style="border: 1px solid black;border-collapse: collapse; background: #d3d3d3;">P</th>
                    <th style="background: #FEBE00; border: 1px solid black;border-collapse: collapse;">
                        L+P</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @foreach ($rw['rt'] as $keyrt => $rt)
                <tr>
                    <td class="text-center" style="border: 1px solid black;border-collapse: collapse;">
                        {{ $keyrt }}</td>
                    <td>RT.00{{ $keyrt }}</td>
                    @foreach ($data['berdasarkan']['list'] as $keyag => $ag)
                        <td style="border: 1px solid black;border-collapse: collapse; text-align: right;">
                            {{ $rt['L'][$ag] }}</td>
                        <td style="border: 1px solid black;border-collapse: collapse; text-align: right;">
                            {{ $rt['P'][$ag] }}</td>
                        <td
                            style=" background: #FEBE00; border: 1px solid black;border-collapse: collapse;text-align: right;">
                            {{ $rt['L'][$ag] + $rt['P'][$ag] }}</td>
                    @endforeach
                    <td class="text-right" style="border: 1px solid black;border-collapse: collapse;text-align: right;">
                        {{ $rt['tlaki'] }}</td>
                    <td class="text-right" style="border: 1px solid black;border-collapse: collapse;text-align: right;">
                        {{ $rt['tperem'] }}</td>
                    <td class="text-right"
                        style="background: #FEBE00; border: 1px solid black;border-collapse: collapse;text-align: right;">
                        {{ $rt['tlaki'] + $rt['tperem'] }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td class="text-center" colspan="2"
                    style="border: 1px solid black;border-collapse: collapse; background: #d3d3d3;">Jumlah
                    RW : 00{{ $keyrw }}</td>
                @foreach ($data['berdasarkan']['list'] as $keyag => $ag)
                    <td
                        style="border: 1px solid black;border-collapse: collapse; background: #d3d3d3; text-align: right;">
                        {{ $rw[$ag]['tlaki'] }}</td>
                    <td
                        style="border: 1px solid black;border-collapse: collapse; background: #d3d3d3; text-align: right;">
                        {{ $rw[$ag]['tperem'] }}</td>
                    <td
                        style="border: 1px solid black;border-collapse: collapse;background: #FEBE00; text-align: right;">
                        {{ $rw[$ag]['tlaki'] + $rw[$ag]['tperem'] }}</td>
                @endforeach
                <td class="text-right"
                    style="border: 1px solid black;border-collapse: collapse;background: #d3d3d3; text-align: right;">
                    {{ $rw['tlaki'] }}
                </td>
                <td class="text-right"
                    style="border: 1px solid black;border-collapse: collapse;background: #d3d3d3; text-align: right;">
                    {{ $rw['tperem'] }}
                </td>
                <td class="text-right"
                    style="border: 1px solid black;border-collapse: collapse;background: #FEBE00; text-align: right;">
                    {{ $rw['tlaki'] + $rw['tperem'] }}</td>
            </tr>
        </tfoot>
        <tr>
            <td colspan="{{ $totalCol }}">&nbsp;</td>
        </tr>
    </table>
    <?php
    $jmlTotalP += $rw['tperem'];
    $jmlTotalL += $rw['tlaki'];
    ?>
@endforeach
<table style="border-collapse: collapse;" width="100%">
    <tfoot>
        <tr>
            <th rowspan="2" style="border: 1px solid black;border-collapse: collapse; background: #d3d3d3;">NO
            </th>
            <th rowspan="2" style="border: 1px solid black;border-collapse: collapse; background: #d3d3d3;">NO RT
            </th>
            @foreach ($data['berdasarkan']['list'] as $key => $row)
                <th colspan="3" style="border: 1px solid black;border-collapse: collapse; background: #d3d3d3;">
                    {{ ucwords($row) }}
                </th>
            @endforeach
            <th colspan="3"
                style="border: 1px solid black;border-collapse: collapse; background: #d3d3d3; font-weight: bold;">
                JUMLAH</th>
        </tr>
        <tr>
            @for ($i = 0; $i <= count($data['berdasarkan']['list']); $i++)
                <th style="border: 1px solid black;border-collapse: collapse; background: #d3d3d3;">L</th>
                <th style="border: 1px solid black;border-collapse: collapse; background: #d3d3d3;">P</th>
                <th style="background: #FEBE00; border: 1px solid black;border-collapse: collapse;">
                    L+P</th>
            @endfor
        </tr>
        <tr>
            <td class="text-center" colspan="2"
                style="border: 1px solid black;border-collapse: collapse; background: #d3d3d3; font-weight: bold;">
                JUMLAH TOTAL</td>
            @foreach ($data['berdasarkan']['list'] as $keyag => $ag)
                <td style="border: 1px solid black;border-collapse: collapse; background: #d3d3d3; text-align: right;">
                    {{ $data[$ag]['tslaki'] > 0 ? $data[$ag]['tslaki'] : '' }}</td>
                <td style="border: 1px solid black;border-collapse: collapse; background: #d3d3d3; text-align: right;">
                    {{ $data[$ag]['tsperem'] > 0 ? $data[$ag]['tsperem'] : '' }}</td>
                <td style="border: 1px solid black;border-collapse: collapse;background: #FEBE00; text-align: right;">
                    {{ $data[$ag]['tslaki'] + $data[$ag]['tsperem'] > 0 ? $data[$ag]['tslaki'] + $data[$ag]['tsperem'] : '' }}
            @endforeach
            <td class="text-right"
                style="border: 1px solid black;border-collapse: collapse;background: #d3d3d3; text-align: right;">
                {{ $data['tslaki'] }}</td>
            <td class="text-right"
                style="border: 1px solid black;border-collapse: collapse;background: #d3d3d3; text-align: right;">
                {{ $data['tsperem'] }}</td>
            <td class="text-right"
                style="border: 1px solid black;border-collapse: collapse;background: #FEBE00; text-align: right;">
                {{ $data['tslaki'] + $data['tsperem'] }}</td>
        </tr>
    </tfoot>
</table>
