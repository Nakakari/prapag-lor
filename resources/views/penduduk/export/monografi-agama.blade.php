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

    .bordered {
        border: 1px solid black;
        border-collapse: collapse;
    }

    .color {
        background: #FEBE00;
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
@foreach ($data['rw'] as $keyrw => $rw)
    <table style="border-collapse: collapse;" width="100%">
        <thead>
            <tr>
                <th colspan="{{ $totalCol }}" style="text-align: left;">NO RW :
                    00{{ isset($keyrw) ? $keyrw : '' }}</th>
            </tr>
            <tr>
                <th rowspan="2" class="bordered">NO</th>
                <th rowspan="2" class="bordered">NO RT</th>
                @foreach ($data['berdasarkan']['list'] as $key => $row)
                    <th colspan="3" class="bordered">{{ ucwords($row['nama']) }}</th>
                @endforeach
                <th colspan="3" class="bordered">JUMLAH</th>
            </tr>
            <tr>
                @for ($i = 0; $i <= count($data['berdasarkan']['list']); $i++)
                    <th class="bordered">L</th>
                    <th class="bordered">P</th>
                    <th class="bordered color">L+P</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @foreach ($rw['rt'] as $keyrt => $rt)
                <tr>
                    <td class="text-center bordered">{{ $keyrt }}</td>
                    <td class="bordered">RT.00{{ $keyrt }}</td>
                    @foreach ($data['berdasarkan']['list'] as $keyag => $ag)
                        <td class="bordered text-right">
                            {{ count($rt['L'][$ag['nama']]) > 0 ? count($rt['L'][$ag['nama']]) : '' }}
                        </td>
                        <td class="bordered text-right">
                            {{ count($rt['P'][$ag['nama']]) > 0 ? count($rt['P'][$ag['nama']]) : '' }}</td>
                        <td class="bordered color text-right">
                            {{ count($rt['L'][$ag['nama']]) + count($rt['P'][$ag['nama']]) > 0 ? count($rt['L'][$ag['nama']]) + count($rt['P'][$ag['nama']]) : '' }}
                        </td>
                    @endforeach
                    <td class="text-right bordered">
                        {{ $rt['tlaki'] > 0 ? $rt['tlaki'] : '' }}</td>
                    <td class="text-right bordered">
                        {{ $rt['tperem'] > 0 ? $rt['tperem'] : '' }}</td>
                    <td class="text-right bordered color">
                        {{ $rt['tlaki'] + $rt['tperem'] > 0 ? $rt['tlaki'] + $rt['tperem'] : '' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td class="text-center bordered" colspan="2" style="font-weight: bold;">Jumlah RW :
                    00{{ $keyrw }}</td>
                @foreach ($data['berdasarkan']['list'] as $keyag => $ag)
                    <td class="bordered text-right">
                        {{ $rw[$ag['nama']]['tlaki'] > 0 ? $rw[$ag['nama']]['tlaki'] : '' }}</td>
                    <td class="bordered text-right">
                        {{ $rw[$ag['nama']]['tperem'] > 0 ? $rw[$ag['nama']]['tperem'] : '' }}</td>
                    <td class="bordered color text-right">
                        {{ $rw[$ag['nama']]['tlaki'] + $rw[$ag['nama']]['tperem'] > 0 ? $rw[$ag['nama']]['tlaki'] + $rw[$ag['nama']]['tperem'] : '' }}
                    </td>
                @endforeach
                <td class="text-right bordered">{{ $rw['tlaki'] > 0 ? $rw['tlaki'] : '' }}
                </td>
                <td class="text-right bordered">
                    {{ $rw['tperem'] > 0 ? $rw['tperem'] : '' }}</td>
                <td class="text-right bordered color">
                    {{ $rw['tlaki'] + $rw['tperem'] > 0 ? $rw['tlaki'] + $rw['tperem'] : '' }}
                </td>
            </tr>
            <tr>
                <td colspan="{{ $totalCol }}">&nbsp;</td>
            </tr>
        </tfoot>
    </table>
@endforeach
<table style="border-collapse: collapse;" width="100%">
    <tfoot>
        <tr>
            <th rowspan="2" class="bordered">NO</th>
            <th rowspan="2" class="bordered">NO RT</th>
            @foreach ($data['berdasarkan']['list'] as $key => $row)
                <th colspan="3" class="bordered">{{ ucwords($row['nama']) }}</th>
            @endforeach
            <th colspan="3" class="bordered">JUMLAH</th>
        </tr>
        <tr>
            @for ($i = 0; $i <= count($data['berdasarkan']['list']); $i++)
                <th class="bordered">L</th>
                <th class="bordered">P</th>
                <th class="bordered color">L+P</th>
            @endfor
        </tr>
        <tr>
            <td class="text-center bordered" colspan="2" style="font-weight: bold;">JUMLAH TOTAL</td>
            @foreach ($data['berdasarkan']['list'] as $keyag => $ag)
                <td class="bordered text-right">
                    {{ $data[$ag['nama']]['tslaki'] > 0 ? $data[$ag['nama']]['tslaki'] : '' }}</td>
                <td class="bordered text-right">
                    {{ $data[$ag['nama']]['tsperem'] > 0 ? $data[$ag['nama']]['tsperem'] : '' }}</td>
                <td class="bordered color text-right">
                    {{ $data[$ag['nama']]['tslaki'] + $data[$ag['nama']]['tsperem'] > 0 ? $data[$ag['nama']]['tslaki'] + $data[$ag['nama']]['tsperem'] : '' }}
                </td>
            @endforeach
            <td class="text-right bordered">{{ $data['tslaki'] }}</td>
            <td class="text-right bordered">{{ $data['tsperem'] }}</td>
            <td class="text-right bordered color">{{ $data['tslaki'] + $data['tsperem'] }}</td>
        </tr>
    </tfoot>
</table>
