@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5>
                        LAPORAN HASIL PENDATAAN RUMAH DESA PRAPAG LOR
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" style="font-size: .75rem;">
                            <thead class="bg-light">
                                <tr>
                                    <th rowspan="3" class="text-center">NO</th>
                                    <th rowspan="3" class="text-center">RW</th>
                                    <th rowspan="3" class="text-center">JUMLAH RUMAH</th>
                                    <th colspan="3" class="text-center">JUMLAH KRT</th>
                                    <th colspan="5" class="text-center">JUMLAH FASILITAS YANG SUDAH ADA</th>
                                </tr>
                                <tr>
                                    <th rowspan="2" class="text-center">L</th>
                                    <th rowspan="2" class="text-center">P</th>
                                    <th rowspan="2" class="text-center">L + P</th>
                                    <th rowspan="2" class="text-center">JAMBAN</th>
                                    <th colspan="3" class="text-center">AIR BERSIH</th>
                                    <th rowspan="2" class="text-center">LISTRIK</th>
                                </tr>
                                <tr>
                                    <th class="text-center">SUMUR GALI</th>
                                    <th class="text-center">SUMUR BOR</th>
                                    <th class="text-center">PAM</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total_rumah = 0;
                                    $total_l = 0;
                                    $total_p = 0;
                                    $total_jamban = 0;
                                    // $total_air_bersih = 0;
                                    $total_sumur_gali = 0;
                                    $total_sumur_bor = 0;
                                    $total_pam = 0;
                                    $total_listrik = 0;
                                @endphp
                                @foreach ($data as $key => $row)
                                    @php
                                        $total_rumah += $row->jumlah_rumah;
                                        $total_l += $row->jumlah_l;
                                        $total_p += $row->jumlah_p;
                                        $total_jamban += $row->jumlah_jamban;
                                        // $total_air_bersih += $row->jumlah_air_bersih;
                                        $total_sumur_gali += $row->jumlah_sumur_gali;
                                        $total_sumur_bor += $row->jumlah_sumur_bor;
                                        $total_pam += $row->jumlah_pam;
                                        $total_listrik += $row->jumlah_listrik;
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">00{{ $row->rw }}</td>
                                        <td class="text-center">{{ number_format($row->jumlah_rumah, 0, ',', '.') }}</td>
                                        <td class="text-center">{{ number_format($row->jumlah_l, 0, ',', '.') }}</td>
                                        <td class="text-center">{{ number_format($row->jumlah_p, 0, ',', '.') }}</td>
                                        <td class="text-center">{{ number_format($row->jumlah_rumah, 0, ',', '.') }}</td>
                                        <td class="text-center">{{ number_format($row->jumlah_jamban, 0, ',', '.') }}</td>
                                        {{-- <td class="text-center">{{$row->jumlah_air_bersih}}</td> --}}
                                        <td class="text-center">{{ number_format($row->jumlah_sumur_gali, 0, ',', '.') }}
                                        </td>
                                        <td class="text-center">{{ number_format($row->jumlah_sumur_bor, 0, ',', '.') }}
                                        </td>
                                        <td class="text-center">{{ number_format($row->jumlah_pam, 0, ',', '.') }}</td>
                                        <td class="text-center">{{ number_format($row->jumlah_listrik, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2" class="text-center font-weight-bolder">JUMLAH</td>
                                    <td class="text-center font-weight-bolder">
                                        {{ number_format($total_rumah, 0, ',', '.') }}</td>
                                    <td class="text-center font-weight-bolder">{{ number_format($total_l, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center font-weight-bolder">{{ number_format($total_p, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center font-weight-bolder">
                                        {{ number_format($total_rumah, 0, ',', '.') }}</td>
                                    <td class="text-center font-weight-bolder">
                                        {{ number_format($total_jamban, 0, ',', '.') }}</td>
                                    {{-- <td class="text-center font-weight-bolder">{{$total_air_bersih}}</td> --}}
                                    <td class="text-center font-weight-bolder">
                                        {{ number_format($total_sumur_gali, 0, ',', '.') }}</td>
                                    <td class="text-center font-weight-bolder">
                                        {{ number_format($total_sumur_bor, 0, ',', '.') }}</td>
                                    <td class="text-center font-weight-bolder">{{ number_format($total_pam, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center font-weight-bolder">
                                        {{ number_format($total_listrik, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
    @if (Auth::user()->role == 'ketua_rt')
        {{-- @php
        $total_penduduk = App\Penduduk::where('rt',auth()->user()->ketua_rt->rt)
        ->where('rw',auth()->user()->ketua_rt->rw)->where('is_penduduk','true')->count();

        $total_penduduk_laki_laki = App\Penduduk::where('rt',auth()->user()->ketua_rt->rt)
        ->where('rw',auth()->user()->ketua_rt->rw)->where('gender','L')->where('is_penduduk','true')->count();
        $total_penduduk_perempuan = App\Penduduk::where('rt',auth()->user()->ketua_rt->rt)
        ->where('rw',auth()->user()->ketua_rt->rw)->where('gender','P')->where('is_penduduk','true')->count();
    @endphp
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <span class="text-muted text-uppercase fs-12 fw-bold">Total Laki-Laki</span>
                        <h3 class="mb-0">{{$total_penduduk_laki_laki}}</h3>
                    </div>
                    <div class="align-self-center flex-shrink-0">
                        <i data-feather="user" class="icon-lg icon-dual-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <span class="text-muted text-uppercase fs-12 fw-bold">Total Perempuan</span>
                        <h3 class="mb-0">{{$total_penduduk_perempuan}}</h3>
                    </div>
                    <div class="align-self-center flex-shrink-0">
                        <i data-feather="user" class="icon-lg icon-dual-danger"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <span class="text-muted text-uppercase fs-12 fw-bold">Total Penduduk</span>
                        <h3 class="mb-0">{{$total_penduduk}}</h3>
                    </div>
                    <div class="align-self-center flex-shrink-0">
                        <i data-feather="user" class="icon-lg icon-dual-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    @endif
@endsection
