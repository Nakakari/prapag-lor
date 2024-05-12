@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow border-bottom-primary">
                <div class="card-header">
                    <div class="float-left">
                        <h6 class="d-inline text-primary">Data Monografi Penduduk Berdasarkan Jenis Kelamin</h6>
                    </div>
                    <div class="float-right">
                        <button type="button" class="btn btn-success print-excel" onclick="exportData('btnExcel')"><svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-file-excel" viewBox="0 0 16 16">
                                <path
                                    d="M5.18 4.616a.5.5 0 0 1 .704.064L8 7.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 8l2.233 2.68a.5.5 0 0 1-.768.64L8 8.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 8 5.116 5.32a.5.5 0 0 1 .064-.704" />
                                <path
                                    d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1" />
                            </svg> Excel
                        </button>
                        <button type="button" class="btn btn-danger print-pdf" onclick="exportData('btnPdf')"><i
                                class="fas fa-file-pdf"></i> PDF
                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    {{-- Rencana sing tak jupuk ngge isi excel e mulai ko iki bos --}}
                    @foreach ($data['data']['rw'] as $keyrw => $rw)
                        <h6>NO RW : 00{{ $keyrw }}</h6>
                        <table class="table table-bordered table-sm" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NO RT</th>
                                    <th>L</th>
                                    <th>P</th>
                                    <th>JUMLAH</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $p = 0;
                                $l = 0;
                                ?>
                                @foreach ($rw['rt'] as $keyrt => $rt)
                                    <tr>
                                        <td class="text-center">{{ $keyrt }}</td>
                                        <td>RT.00{{ $keyrt }}</td>
                                        <td class="text-right">{{ count($rt['L']) }}</td>
                                        <td class="text-right">{{ count($rt['P']) }}</td>
                                        <td class="text-right">{{ count($rt['L']) + count($rt['P']) }}</td>
                                    </tr>
                                    <?php $p += count($rt['P']);
                                    $l += count($rt['L']); ?>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-center" colspan="2">Jumlah RW : 00{{ $keyrw }}</td>
                                    <td class="text-right">{{ $l }}</td>
                                    <td class="text-right">{{ $p }}</td>
                                    <td class="text-right">{{ $l + $p }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    @endforeach

                    {{-- tekan iki --}}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        table>thead>tr>th {
            vertical-align: middle !important;
            text-align: center;
            font-size: 10px;
        }

        table>tbody>tr>td {
            font-size: 10px;
        }

        table>tfoot>tr>td {
            font-size: 10px;
            font-weight: bold;
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
        function exportData(btnType) {
            window.open('/penduduk/export-monografi?' +
                'rt=' + "{{ $request['rt'] ?? '' }}" +
                '&rw=' + "{{ $request['rw'] ?? '' }}" +
                '&kondisi=' + "{{ $request['kondisi'] ?? '' }}" +
                '&btnType=' + btnType
            );
        }
    </script>
@endpush
