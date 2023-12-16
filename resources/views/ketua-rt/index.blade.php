@extends('layouts.app')
@section('title', 'Ketua RT')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card border-bottom-primary">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
                    <a href="{{ route('ketua-rt.create') }}" class="btn btn-primary btn-sm" data-title="Tambah User"
                        data-toggle="tooltip">
                        <i class="fa fa-plus fa-fw"></i>
                        Ketua RT
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" width="100%" id="data-rumah-warga-table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>RT</th>
                                <th>RW</th>
                                <th>NAMA</th>
                                <th>NIK</th>
                                <th>KETERANGAN</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>00{{ $row->rt }}</td>
                                    <td>00{{ $row->rw }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->nik }}</td>
                                    <td>{{ $row->description }}</td>
                                    <td>
                                        <a href="{{ route('ketua-rt.edit', $row->id) }}" class="btn btn-sm btn-success">
                                            <i class="fa fa-edit fa-fw"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger delete-data">
                                            <i class="fa fa-trash fa-fw"></i>
                                        </a>
                                        <form action="{{ route('ketua-rt.destroy', $row->id) }}" method="POST">
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
@push('styles')
    {{-- <style>
    table > thead > tr > th {
        vertical-align: middle !important;
        text-align: center;
        font-size: 10px;
    }
    table > tbody > tr > td {
        font-size: 10px;
    }
</style> --}}
@endpush
@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.delete-data', function(e) {
                e.preventDefault();
                let accept = confirm('Anda yakin hapus data ini?');
                if (accept) {
                    $(this).parent().find('form').submit();
                }
            });

            $('table').DataTable({
                scrollX: true
            });


        })
    </script>
@endpush
