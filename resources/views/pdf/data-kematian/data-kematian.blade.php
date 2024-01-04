@extends('pdf.layouts.layouts-rkpd')
@section('title', $data['title'])
<?php
use App\Helpers\AplikasiHelper;
?>
@section('content')
    <div class="col-lg-12">
        <h4 class="text-center mb-3">{{ $data['title'] }}</h4>
        <div class="text-center">
            {{ $data['sub_title'] }}
        </div>

        <table class="table table-bordered table-sm mb-5">
            <thead>
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
                @if ($data['data']->count())
                    @foreach ($data['data'] as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->nik }}</td>
                            <td>{{ $row->nama }}</td>
                            <td>{{ $row->tanggal_lahir == '1991-01-01' ? '-' : $row->tanggal_lahir->format('d-m-Y') }}</td>
                            <td>{{ $row->alamat }}</td>
                            <td>00{{ $row->rt->name }}</td>
                            <td>00{{ $row->rw->name }}</td>
                            <td>{{ $row->keterangan }}</td>
                            <td>{{ $row->tanggal_pemakaman == '1991-01-01' ? '-' : $row->tanggal_pemakaman->format('d-m-Y') }}
                            </td>
                            <td>{{ $row->nik_pelapor }}</td>
                            <td>{{ $row->nik_pelapor_2 }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="11" class="text-center">Data kosong</td>
                    </tr>
                @endif

            </tbody>
        </table>
        {{-- SIGNATURE --}}
        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td style="width: 50%;"></td>
                    <td style="width: 50%;" align="center">
                        <div class="text-center">
                            <p>{{ AplikasiHelper::desa }}, {{ date('d F Y') }}</p>
                            <p>
                                @if ($data['signature'])
                                    {{ strtoupper($data['signature']['jabatan']) }}
                                @else
                                    KEPALA DESA {{ AplikasiHelper::desa }}
                                @endif
                            </p>
                            <br><br><br>
                            <p>
                                @if ($data['signature'])
                                    {{ strtoupper($data['signature']['name']) }}
                                @else
                                    {{ AplikasiHelper::kades }}
                                @endif
                            </p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
