<?php use Carbon\Carbon; ?>
<table>
    <thead>
        <tr>
            <td colspan="11" style="font-weight: bold; font-size: 16pt; text-align: center; vertical-align: center;">
                {{ $data['title'] }}</td>
        </tr>
        <tr>
            <td colspan="11" style="font-weight: bold; font-size: 16pt; text-align: center; vertical-align: center;">
                {{ $data['sub_title'] }}</td>
        </tr>
        <tr>
            <td colspan="11"></td>
        </tr>
        <tr>
            <th>NO</th>
            <th>NIK</th>
            <th>NAMA LENGKAP</th>
            <th>TANGGAL LAHIR</th>
            <th>ALAMAT</th>
            <th>RT</th>
            <th>RW</th>
            <th>KETERANGAN</th>
            <th>TGL KEMATIAN</th>
            <th>NIK PELAPOR 1</th>
            <th>NIK PELAPOR 2</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data['data'] as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>&nbsp;{{ $row->nik }}</td>
                <td>{{ $row->nama }}</td>
                <td>{{ Carbon::createFromFormat('Y-m-d H:i:s', $row->tanggal_lahir)->format('Y-m-d') }}</td>
                <td>{{ $row->alamat }}</td>
                <td>00{{ $row->rt->name }}</td>
                <td>00{{ $row->rw->name }}</td>
                <td>{{ $row->keterangan }}</td>
                <td>{{ Carbon::createFromFormat('Y-m-d H:i:s', $row->tanggal_pemakaman)->format('Y-m-d') }}</td>
                <td>&nbsp;{{ $row->nik_pelapor }}</td>
                <td>&nbsp;{{ $row->nik_pelapor_2 }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="11" class="text-center">Data kosong</td>
            </tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <td colspan="11" style="text-align: center;"></td>
        </tr>
        <tr>
            <td colspan="9" style="text-align: center;"></td>
            <td style="text-align: center;">
                {{ strtoupper($data['desa']) }},
                {{ strtoupper(date('d F Y')) }}
            </td>
            <td></td>
        </tr>
        <tr>
            <td colspan="9" style="text-align: center;"></td>
            <td style="text-align: center;">
                @if ($data['signature'])
                    {{ strtoupper($data['signature']['jabatan']) }}
                @else
                    KEPALA DESA {{ strtoupper($data['desa']) }}
                @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td colspan="11"></td>
        </tr>
        <tr>
            <td colspan="11"></td>
        </tr>
        <tr>
            <td colspan="11"></td>
        </tr>
        <tr>
            <td colspan="9" style="text-align: center;"></td>
            <td style="text-align: center;">
                @if ($data['signature'])
                    {{ strtoupper($data['signature']['name']) }}
                @else
                    TARMUDI
                @endif
            </td>
            <td></td>
        </tr>
    </tfoot>
</table>
