@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <div class="float-center">
                    <h6></center>REKAPITULASI JUMLAH PENDUDUK BERDASARKAN JENIS KELAMIN</h6>
                </div>
                <div class="float-right">
                    
                    <a href="{{ url('/penduduk') }}" class="btn btn-danger btn-sm"><i class="fas fa-arrow->left"></i> Kembali
                    </a>
                    <a href="{{ url('/penduduk/export-rekap') }}" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i> Export Excel
                    </a>
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
                        <h5 class="text-left">NO RW: 00{{$key}}</h5>
                        <table class="table table-bordered table-sm" id="penduduk-table">                    
                            <thead class="bg-light">
                                <tr>
                                    <th>NO</th>
                                    <th>NO RT</th>
                                    <th>LAKI-LAKI</th>                            
                                    <th>PEREMPUAN</th>                            
                                    <th>JUMLAH</th>
                                </tr>
                            </thead>  
                            <tbody>
                                @php
                                    $total_penduduk = 0;
                                    $total_l = 0;
                                    $total_p = 0;
                                @endphp
                                @foreach($table as $row)
                                @php
                                    $total_penduduk += $row->jumlah_penduduk;
                                    $total_l += $row->jumlah_l;
                                    $total_p += $row->jumlah_p;
                                @endphp
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">00{{$row->rt}}</td>
                                    <td class="text-center">{{$row->jumlah_l}}</td>
                                    <td class="text-center">{{$row->jumlah_p}}</td>
                                    <td class="text-center">{{$row->jumlah_penduduk}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2" class="text-right font-weight-bolder">JUMLAH RW: 00{{$key}}</td>
                                    <td class="text-center font-weight-bolder">{{$total_l}}</td>
                                    <td class="text-center font-weight-bolder">{{$total_p}}</td>
                                    <td class="text-center font-weight-bolder">{{$total_penduduk}}</td>
                                </tr>
                            </tbody>  
                        </table>
                
                
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
@push('styles')
<style>
    .select2-container {
        width: 250px !important;
    }
    table > thead > tr > th {
        vertical-align: middle !important;
        text-align: center;
        font-size: 10px;
    }
    table > tbody > tr > td {
        font-size: 10px;
    }
    .feather-16{
        width: 16px;
        height: 16px;
        }
        .feather-24{
        width: 24px;
        height: 24px;
        }
        .feather-32{
        width: 32px;
        height: 32px;
        }
</style>
@endpush
