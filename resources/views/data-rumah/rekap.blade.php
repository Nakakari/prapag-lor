@extends('layouts.app')
@section('title','Dashboard')
@section('content')
<div class="row justify-content-center">
    
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <div class="float-left">
                    <h6>LAPORAN HASIL PENDATAAN RUMAH  DESA PRAPAG LOR</h6>
                </div>
                <div class="float-right">
                    {{--<a href="{{ url('/sketsa-rumah/create') }}" class="btn btn-info btn-sm"><i class="fas fa-plus"></i> Tambah Data
                    </a> --}}
                    {{-- <a href="{{ url('/sketsa-rumah') }}" class="btn btn-danger btn-sm"><i class="fas fa-arrow->left"></i> Kembali
                    </a>
                    <a href="{{ url('/sketsa-rumah/export-rekap') }}" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i> Export Excel
                    </a> --}}
                    @if (auth()->user()->role == 'admin')
                    {{-- <a href="{{ url('/sketsa-rumah/upload') }}" class="btn btn-info btn-sm"><i class="fas fa-upload"></i> Upload
                    </a> --}}
                    @endif
                </div>
            </div>

            <div class="card-body table-responsive">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if (session('fail'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('fail') }}
                    </div>
                @endif
                
                @foreach($data as $key=>$table)
                        <h5 class="text-center">RW 00{{$key}}</h5>
                        <table class="table table-bordered table-sm" id="sketsa-rumah-table" style="font-size: .75rem;">                    
                            <thead class="bg-light">
                                <tr>
                                    <th rowspan="3" class="text-center">NO</th>
                                    <th rowspan="3" class="text-center">RT</th>
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
                                @foreach($table as $row)
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
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">00{{$row->name}}</td>
                                    <td class="text-center">00{{$key}}</td>
                                    <td class="text-center">{{$row->jumlah_rumah}}</td>
                                    <td class="text-center">{{$row->jumlah_l}}</td>
                                    <td class="text-center">{{$row->jumlah_p}}</td>
                                    <td class="text-center">{{$row->jumlah_rumah}}</td>
                                    <td class="text-center">{{$row->jumlah_jamban}}</td>
                                    {{-- <td class="text-center">{{$row->jumlah_air_bersih}}</td> --}}
                                    <td class="text-center">{{$row->jumlah_sumur_gali}}</td>
                                    <td class="text-center">{{$row->jumlah_sumur_bor}}</td>
                                    <td class="text-center">{{$row->jumlah_pam}}</td>
                                    <td class="text-center">{{$row->jumlah_listrik}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" class="text-center font-weight-bolder">JUMLAH</td>
                                    <td class="text-center font-weight-bolder">{{$total_rumah}}</td>
                                    <td class="text-center font-weight-bolder">{{$total_l}}</td>
                                    <td class="text-center font-weight-bolder">{{$total_p}}</td>
                                    <td class="text-center font-weight-bolder">{{$total_rumah}}</td>
                                    <td class="text-center font-weight-bolder">{{$total_jamban}}</td>
                                    {{-- <td class="text-center font-weight-bolder">{{$total_air_bersih}}</td> --}}
                                    <td class="text-center font-weight-bolder">{{$total_sumur_gali}}</td>
                                    <td class="text-center font-weight-bolder">{{$total_sumur_bor}}</td>
                                    <td class="text-center font-weight-bolder">{{$total_pam}}</td>
                                    <td class="text-center font-weight-bolder">{{$total_listrik}}</td>
                                </tr>
                            </tbody>  
                        </table>
                
                
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
