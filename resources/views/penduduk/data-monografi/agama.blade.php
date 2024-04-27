@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <div class="float-left">
                        <h6 class="d-inline">Data Monografi Penduduk Berdasarkan {{ $data['data']['berdasarkan']['judul'] }}
                        </h6>
                    </div>
                    <div class="float-right">
                        <a onclick="exportData('btnExcel')" class="btn btn-success print-excel text-white"><svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-file-excel" viewBox="0 0 16 16">
                                <path
                                    d="M5.18 4.616a.5.5 0 0 1 .704.064L8 7.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 8l2.233 2.68a.5.5 0 0 1-.768.64L8 8.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 8 5.116 5.32a.5.5 0 0 1 .064-.704" />
                                <path
                                    d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1" />
                            </svg> Excel
                        </a>
                        <a onclick="exportData('btnPdf')" class="btn btn-danger print-pdf text-white"><i
                                class="fas fa-file-pdf"></i>
                            PDF
                        </a>
                    </div>
                </div>

                <div class="card-body table-responsive">

                    <input type="hidden" id="filter-kondisi" value="{{ $request['kondisi'] }}" />
                    <input type="hidden" id="filter-rt" value="{{ $request['rt'] }}" />
                    <input type="hidden" id="filter-rw" value="{{ $request['rw'] }}" />

                    @foreach ($data['data']['rw'] as $keyrw => $rw)
                        <h6>NO RW : 00{{ $keyrw }}</h6>
                        <table class="table table-bordered table-sm" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th rowspan="2">NO</th>
                                    <th rowspan="2">NO RT</th>
                                    @foreach ($data['data']['berdasarkan']['list'] as $key => $row)
                                        <th colspan="3">{{ ucwords($row) }}</th>
                                    @endforeach
                                    <th colspan="3">JUMLAH</th>
                                </tr>
                                <tr>
                                    @for ($i = 0; $i <= count($data['data']['berdasarkan']['list']); $i++)
                                        <th>L</th>
                                        <th>P</th>
                                        <th>L+P</th>
                                    @endfor
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rw['rt'] as $keyrt => $rt)
                                    <tr>
                                        <td class="text-center">{{ $keyrt }}</td>
                                        <td>RT.00{{ $keyrt }}</td>
                                        @foreach ($data['data']['berdasarkan']['list'] as $keyag => $ag)
                                            <td>{{ count($rt['L'][$ag]) }}</td>
                                            <td>{{ count($rt['P'][$ag]) }}</td>
                                            <td>{{ count($rt['L'][$ag]) + count($rt['P'][$ag]) }}</td>
                                        @endforeach
                                        <td class="text-right">{{ $rt['tlaki'] }}</td>
                                        <td class="text-right">{{ $rt['tperem'] }}</td>
                                        <td class="text-right">{{ $rt['tlaki'] + $rt['tperem'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-center" colspan="2">Jumlah RW : 00{{ $keyrw }}</td>
                                    @foreach ($data['data']['berdasarkan']['list'] as $keyag => $ag)
                                        <td>{{ $rw[$ag]['tlaki'] }}</td>
                                        <td>{{ $rw[$ag]['tperem'] }}</td>
                                        <td>{{ $rw[$ag]['tlaki'] + $rw[$ag]['tperem'] }}</td>
                                    @endforeach
                                    <td class="text-right">{{ $rw['tlaki'] }}</td>
                                    <td class="text-right">{{ $rw['tperem'] }}</td>
                                    <td class="text-right">{{ $rw['tlaki'] + $rw['tperem'] }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    @endforeach
                    <table class="table table-bordered table-sm" style="width: 100%;">
                        <thead>
                            <tr>
                                <th rowspan="2" class="bordered">NO</th>
                                <th rowspan="2" class="bordered">NO RT</th>
                                @foreach ($data['data']['berdasarkan']['list'] as $key => $row)
                                    <th colspan="3" class="bordered">{{ ucwords($row) }}</th>
                                @endforeach
                                <th colspan="3" class="bordered">JUMLAH</th>
                            </tr>
                            <tr>
                                @for ($i = 0; $i <= count($data['data']['berdasarkan']['list']); $i++)
                                    <th class="bordered">L</th>
                                    <th class="bordered">P</th>
                                    <th class="bordered color">L+P</th>
                                @endfor
                            </tr>
                            <tr>
                                <th class="text-center bordered" colspan="2">JUMLAH TOTAL</th>
                                @foreach ($data['data']['berdasarkan']['list'] as $keyag => $ag)
                                    <th class="text-right">
                                        {{ $data['data'][$ag]['tslaki'] > 0 ? $data['data'][$ag]['tslaki'] : '' }}</th>
                                    <th class="text-right">
                                        {{ $data['data'][$ag]['tsperem'] > 0 ? $data['data'][$ag]['tsperem'] : '' }}</th>
                                    <th class="text-right">
                                        {{ $data['data'][$ag]['tslaki'] + $data['data'][$ag]['tsperem'] > 0 ? $data['data'][$ag]['tslaki'] + $data['data'][$ag]['tsperem'] : '' }}
                                    </th>
                                @endforeach
                                <th class="text-right">{{ $data['data']['tslaki'] }}</th>
                                <th class="text-right">{{ $data['data']['tsperem'] }}</th>
                                <th class="text-right">{{ $data['data']['tslaki'] + $data['data']['tsperem'] }}</th>
                            </tr>
                        </thead>
                    </table>
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
                'kondisi=' + $("#filter-kondisi").val() +
                '&rt=' + $("#filter-rt").val() +
                '&rw=' + $("#filter-rw").val() +
                '&btnType=' + btnType
            );
        }
    </script>
@endpush
