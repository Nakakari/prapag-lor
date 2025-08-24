@extends('layouts.app')
@section('title', 'Surat Kuasa')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h6>Surat Kuasa</h6>
                    </div>
                    <div class="float-right">
                        <button class="btn btn-danger btn-sm" onclick="suratKuasaExport('btnPdf')">
                            <i class="fas fa-file-pdf"></i> PDF
                        </button>
                        <button class="btn btn-success btn-sm" onclick="suratKuasaExport('btnExcel')">
                            <i class="fas fa-file-pdf"></i> EXCEL
                        </button>

                        <a href="{{ route('surat-kuasa.create') }}" class="btn btn-info btn-sm"><i class="fas fa-plus"></i>
                            Tambah Data
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

                    <form action="" method="GET" id="filter-form">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Bulan</label>
                                    <select name="bulan" class="form-control" id="bulan">
                                        <option value="all" data-href="{{ route('surat-kuasa.index') }}">Semua
                                            Bulan
                                        </option>
                                        <option value="01"
                                            data-href="{{ route('surat-kuasa.index', ['bulan' => '01']) }}"
                                            {{ request()->get('bulan') == '01' ? 'selected' : '' }}>Januari</option>
                                        <option value="02"
                                            data-href="{{ route('surat-kuasa.index', ['bulan' => '02']) }}"
                                            {{ request()->get('bulan') == '02' ? 'selected' : '' }}>Februari</option>
                                        <option value="03"
                                            data-href="{{ route('surat-kuasa.index', ['bulan' => '03']) }}"
                                            {{ request()->get('bulan') == '03' ? 'selected' : '' }}>Maret</option>
                                        <option value="04"
                                            data-href="{{ route('surat-kuasa.index', ['bulan' => '04']) }}"
                                            {{ request()->get('bulan') == '04' ? 'selected' : '' }}>April</option>
                                        <option value="05"
                                            data-href="{{ route('surat-kuasa.index', ['bulan' => '05']) }}"
                                            {{ request()->get('bulan') == '05' ? 'selected' : '' }}>Mei</option>
                                        <option value="06"
                                            data-href="{{ route('surat-kuasa.index', ['bulan' => '06']) }}"
                                            {{ request()->get('bulan') == '06' ? 'selected' : '' }}>Juni</option>
                                        <option value="07"
                                            data-href="{{ route('surat-kuasa.index', ['bulan' => '07']) }}"
                                            {{ request()->get('bulan') == '07' ? 'selected' : '' }}>Juli</option>
                                        <option value="08"
                                            data-href="{{ route('surat-kuasa.index', ['bulan' => '08']) }}"
                                            {{ request()->get('bulan') == '08' ? 'selected' : '' }}>Agustus</option>
                                        <option value="09"
                                            data-href="{{ route('surat-kuasa.index', ['bulan' => '09']) }}"
                                            {{ request()->get('bulan') == '09' ? 'selected' : '' }}>September</option>
                                        <option value="10"
                                            data-href="{{ route('surat-kuasa.index', ['bulan' => '10']) }}"
                                            {{ request()->get('bulan') == '10' ? 'selected' : '' }}>Oktober</option>
                                        <option value="11"
                                            data-href="{{ route('surat-kuasa.index', ['bulan' => '11']) }}"
                                            {{ request()->get('bulan') == '11' ? 'selected' : '' }}>November</option>
                                        <option value="12"
                                            data-href="{{ route('surat-kuasa.index', ['bulan' => '12']) }}"
                                            {{ request()->get('bulan') == '12' ? 'selected' : '' }}>Desember</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Tahun</label>
                                    <select name="tahun" class="form-control" id="tahun">
                                        @foreach (DB::select('SELECT DISTINCT YEAR(tanggal) AS tahun FROM `surat_kuasa`') as $row)
                                            <option value="{{ $row->tahun }}"
                                                {{ request()->get('tahun') == $row->tahun ? 'selected' : '' }}>
                                                {{ $row->tahun }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group" style="padding-top: 1.85rem;">
                                    <a href="{{ route('surat-kuasa.index') }}" class="btn btn-info">Reset</a>
                                </div>
                            </div>
                        </div>
                    </form>


                    <table class="table table-bordered table-sm" id="surat_kuasa" style="width: 100%;">
                        <thead>
                            <tr>
                                <th rowspan="2">NO</th>
                                <th rowspan="2">NOMOR SURAT</th>
                                <th rowspan="2">TANGGAL SURAT</th>
                                <th colspan="2">PEMBERI KUASA</th>
                                <th colspan="2">PENERIMA KUASA</th>
                                <th rowspan="2">PEMBUAT SURAT</th>
                                <th rowspan="2">LIHAT FILE</th>
                                <th rowspan="2">AKSI</th>
                            </tr>
                            <tr>
                                <th>NIK</th>
                                <th>NAMA</th>
                                <th>NIK</th>
                                <th>NAMA</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td style="white-space: nowrap;" class="text-center">{{ $loop->iteration }}</td>
                                    <td style="white-space: nowrap;">{{ $row->nomor_surat }}</td>
                                    <td style="white-space: nowrap;">{{ date('d/m/Y', strtotime($row->tanggal)) }}</td>
                                    <td style="white-space: nowrap;">{{ $row->nik_pemberi_kuasa }}
                                    </td>
                                    <td style="white-space: nowrap;">
                                        {{ $row->nama_pemberi_kuasa }}</td>
                                    <td style="white-space: nowrap;">
                                        {{ $row->nik_penerima_kuasa }}</td>
                                    <td style="white-space: nowrap;">
                                        {{ $row->nama_penerima_kuasa }}</td>

                                    <td style="white-space: nowrap;">
                                        {{ $row->user->name }}</td>
                                    <td style="white-space: nowrap;">
                                        <a href="{{ route('surat-kuasa.cetak', $row->id) }}" target="__blank">Lihat
                                            Surat</a>
                                    </td>
                                    <td style="white-space: nowrap;">
                                        {{-- @if (in_array(auth()->user()->role, ['admin', 'kaur_umum'])) --}}
                                        <a href="{{ route('surat-kuasa.edit', $row->id) }}"
                                            class="btn btn-success btn-sm"><i class="fa fa-pen"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm delete-data"><i
                                                class="fa fa-trash"></i></a>
                                        <form action="{{ route('surat-kuasa.destroy', $row->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        {{-- @endif --}}
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
@include('plugins.select2')
@include('plugins.datatables')
@push('styles')
    <style>
        .select2-container {
            width: 250px !important;
        }

        table>thead>tr>th {
            vertical-align: middle !important;
            text-align: center;
            font-size: 10px;
        }

        table>tbody>tr>td {
            font-size: 10px;
        }

        .feather-16 {
            width: 16px;
            height: 16px;
        }

        .feather-24 {
            width: 24px;
            height: 24px;
        }

        .feather-32 {
            width: 32px;
            height: 32px;
        }
    </style>
@endpush
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#surat_kuasa').DataTable({
                scrollX: true
            });

            $(document).on('change', '#bulan, #tahun', function() {
                let month = $('#bulan').find(':selected').val()
                let year = $('#tahun').find(':selected').val()

                if (month) {
                    if (year) {
                        $('#filter-form').submit()
                    }
                }

                if (year) {
                    if (month) {
                        $('#filter-form').submit()
                    }
                }
            })

            $(document).on('click', '.delete-data', function(e) {
                e.preventDefault();
                let accept = confirm('Anda yakin hapus data ini?');
                if (accept) {
                    $(this).parent().find('form').submit();
                }
            });

        });

        $(document).on('click', '.button-show-qrcode', function(e) {
            e.preventDefault();
            let url = $(this).data('url');
            let modal = $('#qrcode-modal')

            $.ajax({
                method: 'GET',
                url: url,
                success: function(data) {
                    modal.find('.modal-body').html(data)
                    modal.modal('show');
                }
            })

        })

        function suratKuasaExport(btnType) {
            window.open("{{ route('surat-kuasa.report-export') }}?" +
                'bulan=' + $("input[name='bulan']").val() +
                '&tahun=' + $("input[name='tahun']").val() +
                '&btnType=' + btnType
            );
        }
    </script>
@endpush
