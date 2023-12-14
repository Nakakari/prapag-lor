@extends('layouts.app')
@section('title','Data Rumah')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card border-bottom-primary">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
                <a href="{{route('data-rumah.create')}}" class="btn btn-primary btn-sm" data-title="Tambah User" data-toggle="tooltip">
                    <i class="fa fa-plus fa-fw"></i>
                    Data Rumah
                </a>
            </div>
            <div class="card-body">
                <table class="table table-bordered" width="100%" id="data-rumah-table">                    
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-nowrap">NO</th>
                            <th rowspan="2" class="text-nowrap">NOMOR RUMAH</th>
                            <th rowspan="2" class="text-nowrap">JENIS DINDING</th>                            
                            <th rowspan="2" class="text-nowrap">JENIS LANTAI</th>                            
                            <th rowspan="2" class="text-nowrap">JENIS ATAP</th>                            
                            <th rowspan="2" class="text-nowrap">LUAS M2</th>                            
                            <th rowspan="2" class="text-nowrap">KEPALA RUMAH TANGGA</th>                            
                            <th rowspan="2" class="text-nowrap">JENIS KELAMIN</th>                            
                            <th colspan="2" class="text-nowrap">ALAMAT</th>                            
                            <th rowspan="2" class="text-nowrap">NAMA KETUA RT</th>
                            <th colspan="3" class="text-nowrap">FASILITAS YANG SUDAH ADA</th>
                            <th rowspan="2" class="text-nowrap">FOTO RUMAH</th>
                            <th rowspan="2" class="text-nowrap">AKSI</th>
                        </tr>
                        <tr>
                            <th class="text-nowrap">RT</th>
                            <th class="text-nowrap">RW</th>
                            <th class="text-nowrap">JAMBAN</th>
                            <th class="text-nowrap">AIR BERSIH</th>
                            <th class="text-nowrap">LISTRIK</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            @foreach ($data as $row)
                            <tr>
                                <td style="white-space: nowrap;">{{ $loop->iteration }}</td>
                                <td style="white-space: nowrap;">{{ $row->nomor_rumah }}</td>
                                <td style="white-space: nowrap;">{{ ucwords($row->jenis_dinding) }}</td>
                                <td style="white-space: nowrap;">{{ ucwords($row->jenis_lantai) }}</td>
                                <td style="white-space: nowrap;">{{ ucwords($row->jenis_atap) }}</td>
                                <td style="white-space: nowrap;">{{ $row->luas }}</td>
                                <td style="white-space: nowrap;">{{ $row->kepala_keluarga }}</td>                                
                                <td style="white-space: nowrap; text-align: center;">{{ ucwords($row->jenis_kelamin) }}</td>
                                <td style="white-space: nowrap;">00{{ $row->rt }}</td>                                
                                <td style="white-space: nowrap;">00{{ $row->rw }}</td>                                
                                <td style="white-space: nowrap;">{{ $row->ketua_rt }}</td>                                
                                <td class="text-center text-nowrap">{{ $row->jamban ? 'V':'' }}</td>                                
                                <td class="text-center text-nowrap">
                                    @if ($row->air_bersih == 'sumur_gali')
                                        Sumur Gali
                                    @elseif($row->air_bersih == 'sumur_bor')
                                        Sumur Bor
                                    @elseif($row->air_bersih == 'pam')
                                        PAM
                                    @else
                                        
                                    @endif
                                </td>                                
                                {{-- <td class="text-center text-nowrap">
                                    {{ $row->air_bersih ? (in_array('sumur_bor',json_decode($row->air_bersih,TRUE)) ? 'V':''):'' }}
                                    {{ $row->air_bersih == 'sumur_bor' ? 'V':'' }}
                                </td>                                
                                <td class="text-center text-nowrap">
                                    {{ $row->air_bersih ? (in_array('pam',json_decode($row->air_bersih,TRUE)) ? 'V':''):'' }}
                                    {{ $row->air_bersih == 'pam' ? 'V':'' }}
                                </td>                                 --}}
                                <td class="text-center text-nowrap">{{ $row->listrik ? 'V':'' }}</td>                                
                                <td style="white-space: nowrap;">
                                    <a href="{{ asset($row->foto_rumah) }}" class="show-photo" target="_blank">Foto Rumah</a>
                                </td>                                
                                
                                <td style="white-space: nowrap;">
                                    <a href="{{ route('data-rumah.show',$row->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('data-rumah.edit',$row->id) }}" class="btn btn-success btn-sm"><i class="fa fa-pen"></i></a>
                                    <a href="{{ route('data-rumah.destroy',$row->id) }}" class="btn btn-danger btn-sm delete-data"><i class="fa fa-trash"></i></a>
                                </td>                          
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-foto-rumah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Foto Rumah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <img src="#" alt="" class="img img-fluid">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection
@include('plugins.datatables')
@push('styles')
<style>
    table > thead > tr > th {
        vertical-align: middle !important;
        text-align: center;
        font-size: 10px;
    }
    table > tbody > tr > td {
        font-size: 10px;
    }
</style>
@endpush
@push('scripts')
<script>
    $(document).ready(function(){
        $(document).on('click','.delete-data',function(e){
            e.preventDefault();
            let accept = confirm('Anda yakin hapus data ini?');
            if(accept){
                $(this).parent().find('form').submit();
            }
        });

        $('table').DataTable({
            scrollX: true
        });

        $(document).on('click','.show-photo',function(e){
            e.preventDefault()

            let src = $(this).attr('href');
            $('#modal-foto-rumah').modal('show')
            $('#modal-foto-rumah').find('img').attr('src',src);
        })

        $('#modal-foto-rumah').on('hidden.bs.modal',function(){
            $('#modal-foto-rumah').find('img').attr('src','');
        })
        
    })
</script>
@endpush