@extends('layouts.app')
@section('title', 'Data Kematian')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>

                    </div>
                    <div class="float-right">
                        @if (in_array(auth()->user()->username, ['tolib', 'admin']))
                            <a href="{{ route('data-kematian.create') }}" class="btn btn-info btn-sm"><i
                                    class="fas fa-plus"></i> Tambah Data
                            </a>
                        @endif
                        @if (auth()->user()->username == 'tolib' || auth()->user()->role == 'admin')
                            <a href="{{ route('data-kematian.print-excel') }}" class="btn btn-success btn-sm print-excel"><i
                                    class="fas fa-file-excel"></i>
                                Print Excel
                            </a>
                            <a href="{{ route('data-kematian.print') }}" class="btn btn-danger btn-sm print-pdf"><i
                                    class="fas fa-file-pdf"></i> Print
                                PDF
                            </a>
                        @endif

                        @if (auth()->user()->username == 'tolib' || auth()->user()->role == 'admin')
                            <a href="{{ route('data-kematian.upload-form') }}" class="btn btn-info btn-sm"><i
                                    class="fas fa-upload"></i> Upload
                            </a>
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

                    <form action="{{ route('data-kematian.index') }}" method="GET">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group row">
                                    <label for="rw" class="col-lg-4">RW</label>
                                    <div class="col-lg-8">
                                        <select name="rw"
                                            class="form-control form-control-sm @if ($errors->has('rw')) is-invalid @endif "
                                            id="rw">
                                            <option value=""> -- Pilih RW -- </option>
                                            @foreach ($rw as $row)
                                                <option value="{{ $row->id }}"
                                                    {{ request()->get('rw') ? (request()->get('rw') == $row->id ? 'selected' : '') : '' }}
                                                    data-rt="{{ $row->rts }}">
                                                    00{{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group row">
                                    <label for="rt" class="col-lg-4">RT</label>
                                    <div class="col-lg-8">
                                        <select name="rt"
                                            class="form-control form-control-sm @if ($errors->has('rt')) is-invalid @endif "
                                            id="rt" disabled>
                                            <option value=""> -- Pilih RT -- </option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <button type="submit" class="btn btn-info btn-sm">
                                    <i class="fa fa-filter"></i> Filter
                                </button>
                                <a href="{{ route('data-kematian.index') }}" class="btn btn-danger btn-sm">
                                    <i class="fa fa-sync-alt"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>
                    <table class="table table-bordered" width="100%" id="buku-pemakaman-table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>TAHUN</th>
                                <th>NIK</th>
                                <th>NAMA</th>
                                <th>JENIS KELAMIN</th>
                                <th>RT</th>
                                <th>RW</th>
                                <th>NAMA AYAH</th>
                                <th>NAMA IBU</th>
                                <th>TEMPAT TANGGAL MENINGGAL</th>
                                <th>TANGGAL PEMAKAMAN</th>
                                <th>NAMA PELAPOR</th>
                                <th>NIK PELAPOR</th>
                                {{-- <th>NAMA KELUARGA YANG DAPAT DIHUBUNGI</th> --}}
                                <th>PENYEBAB KEMATIAN</th>
                                <th>KETERANGAN</th>
                                @if (auth()->user()->username == 'tolib' || auth()->user()->role == 'admin')
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->tahun }}</td>
                                    <td>{{ $row->nik }}</td>
                                    <td>{{ $row->nama }}</td>
                                    <td>{{ $row->jenisKelamin->name }}</td>
                                    <td>00{{ $row->rt->name }}</td>
                                    <td>00{{ $row->rw->name }}</td>
                                    <td>{{ $row->nama_ayah }}</td>
                                    <td>{{ $row->nama_ibu }}</td>
                                    <td>{{ $row->tempat_tanggal_meninggal }}</td>
                                    <td>{{ $row->tanggal_pemakaman ? $row->tanggal_pemakaman->format('d-m-Y') : '' }}</td>
                                    <td>{{ $row->nama_pelapor }}</td>
                                    <td>{{ $row->nik_pelapor }}</td>
                                    <td>{{ $row->penyebab_kematian }}</td>
                                    <td>{{ $row->keterangan }}</td>
                                    @if (in_array(auth()->user()->username, ['tolib', 'admin']))
                                        <td class="text-nowrap">
                                            <a href="{{ route('data-kematian.edit', $row->id) }}"
                                                class="btn btn-success btn-sm"><i class="fa fa-pen"></i></a>
                                            <a href="{{ route('data-kematian.surat-kematian', $row->id) }}"
                                                class="btn btn-info btn-sm print-surat-kematian"><i
                                                    class="fa fa-print"></i>Cetak</a>
                                            <a href="{{ route('data-kematian.destroy', $row->id) }}"
                                                class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-print-excel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Print Excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" action="GET" id="print-form">
                        <div class="form-group form-year">
                            <label>Tahun</label>
                            <select name="year" id="" class="form-control year">
                                <option></option>
                                @foreach ($tahun as $key => $row)
                                    <option value="{{ $row->tahun }}">{{ $row->tahun }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group form-start-month">
                            <label>Dari Bulan</label>
                            <select name="start_month" id="" class="form-control start_month">
                                <option></option>

                                @foreach ($bulan as $key => $row)
                                    <option value="{{ $key }}">{{ $row }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group form-end-month">
                            <label>Ke Bulan</label>
                            <select name="end_month" id="" class="form-control end_month">
                                <option></option>

                                @foreach ($bulan as $key => $row)
                                    <option value="{{ $key }}">{{ $row }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Penanda Tangan</label>
                            <select name="signature" class="form-control pejabat" required>
                                <option></option>
                                @foreach ($listPejabat as $item)
                                    <option value="{{ $item['name'] }}">{{ $item['name'] }} - {{ $item['jabatan'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                    <button type="submit" class="btn btn-success">Cetak</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
@include('plugins.select2')
@include('plugins.datatables')
@push('styles')
    <style>
        .select2-container .select2-selection--single .select2-selection__clear {
            position: relative;
            right: 16px;
        }

        table>thead>tr>th {
            vertical-align: middle !important;
            text-align: center;
            font-size: 10px;
        }

        table>tbody>tr>td {
            font-size: 10px;
        }
    </style>
@endpush
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#buku-pemakaman-table').DataTable({
                scrollX: true,
            });

            $('.pejabat').select2({
                placeholder: 'Pilih Pejabat',
                allowClear: true,
                dropdownParent: $('#modal-print-excel'),
            });

            $('.pejabat2').select2({
                placeholder: 'Pilih Pejabat',
                allowClear: true,
                dropdownParent: $('.modal'),
            });

            $('.year').select2({
                allowClear: true,
                placeholder: '-- Pilih Tahun --'
            });

            $('.start_month').select2({
                allowClear: true,
                placeholder: '-- Pilih Bulan Awal--'
            });

            $('.end_month').select2({
                allowClear: true,
                placeholder: '-- Pilih Bulan Akhir--'
            });

            /* RW */
            $('#rw').select2({
                allowClear: true,
                placeholder: '-- Pilih RW --'
            })

            $('#rt').select2({
                allowClear: true,
                placeholder: '-- Pilih RT --',
            })


            $(document).on('click', '.print-excel', function(e) {
                e.preventDefault();
                $('.form-year').show()
                $('.form-start-month').show()
                $('.form-end-month').show()

                let url = $(this).attr('href');
                $('#print-form').attr('action', url);
                $('.modal-title').html('Print Excel')
                $('#modal-print-excel').modal('show');
            })

            $(document).on('click', '.print-pdf', function(e) {
                e.preventDefault();
                $('.form-year').show()
                $('.form-start-month').show()
                $('.form-end-month').show()
                let url = $(this).attr('href');
                $('#print-form').attr('action', url);
                $('.modal-title').html('Print PDF')
                $('#modal-print-excel').modal('show');
            })

            $(document).on('click', '.print-surat-kematian', function(e) {
                e.preventDefault();
                $('.form-year').hide()
                $('.form-start-month').hide()
                $('.form-end-month').hide()
                let url = $(this).attr('href');
                $('#print-form').attr('action', url);
                $('.modal-title').html('Print Surat Kematian')
                $('#modal-print-excel').modal('show');
            })

        });

        $(document).on('change', '#rt', function(e) {
            e.preventDefault();
            setKetuaRt()
        })

        $(document).on('change', '#rw', function(e) {
            e.preventDefault();
            $('#rt').empty();
            $('#rt').append(`<option value=""></option>`)
            let rts = $(this).find(':selected').data('rt')

            $.each(rts, function(index, val) {
                $('#rt').append(
                    `<option value="${val.name}" data-ketua-rt="${val.ketua_rt}">00${val.name}</option>`
                )
            })

            $('#rt').prop('disabled', false)

        })

        @if (request()->get('rt'))
            let rts = $('#rw').find('option:selected').data('rt')
            $.each(rts, function(index, val) {
                $('#rt').append(
                    `<option value="${val.name}" data-ketua-rt="${val.ketua_rt}" ${'{{ request()->get('rt') }}' == val.name ? 'selected':''}>00${val.name}</option>`
                )
            })
            $('#rt').prop('disabled', false)

            $('#rt').select2({
                allowClear: true,
                placeholder: '-- Pilih RT --',
            })
        @endif


        function setKetuaRt() {
            let ketua_rt = $('#rt').find(':selected').data('ketua-rt');
            $('#ketua_rt').val(ketua_rt)
        }
    </script>
@endpush
