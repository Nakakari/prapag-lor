@extends('layouts.app')
@section('title','User')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card border-bottom-primary">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
                <a href="{{route('user.create')}}" class="btn btn-primary btn-sm" data-title="Tambah User" data-toggle="tooltip">
                    <i class="fa fa-plus fa-fw"></i>
                    User
                </a>
            </div>
            <div class="card-body">
                <table class="table table-sm" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $row)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td class="text-nowrap">{{$row->name}}</td>
                            <td class="text-nowrap">{{$row->username}}</td>
                            <td class="text-nowrap">{{$row->email}}</td>
                            <td class="text-nowrap">{{$row->role}}</td>
                            <td class="text-nowrap">
                                <a href="{{route('user.edit',$row->id)}}" class="btn btn-sm btn-success">
                                    <i class="fa fa-edit fa-fw"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-danger delete-data">
                                    <i class="fa fa-trash fa-fw"></i>
                                </a>
                                <form action="{{route('user.destroy',$row->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@include('plugins.datatables')
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

        
    })
</script>
@endpush